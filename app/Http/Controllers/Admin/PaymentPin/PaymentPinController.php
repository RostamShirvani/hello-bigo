<?php

namespace App\Http\Controllers\Admin\PaymentPin;

use App\Enums\EAppType;
use App\Events\PaymentPinIsLowEvent;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Admin\PaymentPin\StorePaymentPinRequest;
use App\Http\Requests\Admin\PaymentPin\StoreUsingRequest;
use App\Repositories\Admin\PaymentPinRepository;
use App\ThirdParties\BigoAPI\BigoAPI;
use App\ThirdParties\LikeeAPI\LikeeAPI;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class PaymentPinController extends BaseAdminController
{
    protected $bookingRepository;

    public function __construct(PaymentPinRepository $paymentPinRepository)
    {
        $this->paymentPinRepository = $paymentPinRepository;
    }

    public function index(Request $request)
    {
        $paymentPins = $this->paymentPinRepository->getPaymentPins();
        return view('admin.payment_pin.index', compact('paymentPins'));
    }

    public function create(Request $request)
    {
        if ($request->input('type') === 'bulk') {
            return view('admin.payment_pin.bulk');
        } elseif ($request->input('type') === 'file') {
            return view('admin.payment_pin.file');
        }

        return view('admin.payment_pin.create');
    }

    public function store(StorePaymentPinRequest $request)
    {
        $type = $request->input('type') ?? 'single';

        if ($type === 'bulk') {
            $paymentPins = $this->paymentPinRepository->bulkStore($request);

            if (empty($paymentPins)) {
                return Redirect::back()->with([
                    'error' => __trans('admin/general', 'failed-insert'),
                ]);
            }
        } elseif ($type === 'file') {
            $paymentPins = $this->paymentPinRepository->fileStore($request);

            if (empty($paymentPins)) {
                return Redirect::back()->with([
                    'error' => __trans('admin/general', 'failed-insert'),
                ]);
            }
        } else {
            $paymentPin = $this->paymentPinRepository->store($request);
        }

        return Redirect::route('admin.payment-pins.index')->with([
            'success' => __trans('admin/general', 'success-insert'),
        ]);
    }

    public function using()
    {
        $paymentPins = $this
            ->paymentPinRepository
            ->getActivePaymentPins()
            ->unique(['amount'])
            ->sortBy('amount', SORT_ASC);


        return view('admin.payment_pin.using', compact('paymentPins'));
    }

    // Do charge from admin panel
    public function storeUsing(StoreUsingRequest $request)
    {
        $data = [
            'bigo_id' => $request->input('bigo_id'),
            'app_type' => $request->input('app_type') ?? EAppType::BIGO_LIVE,
            'amount' => $request->input('amount'),
        ];

        return $this->commonStoreUsing($data);
    }

    // Do charge from shop
    public function storeUsingAfterPay($orderItem)
    {
//        Log::channel('requests')->info('request', $request->all());
//        if (!empty($request->input('order_data'))) {
//            $orderData = json_decode($request->input('order_data'), true);
//            if (!empty($orderData['billing']['phone'])) {
//                $mobile = $orderData['billing']['phone'];
//            }
//
//            if (empty($mobile) && !empty($orderData['shipping']['phone'])) {
//                $mobile = $orderData['shipping']['phone'];
//            }
//            file_put_contents('amin.txt', 'mob : ' . $mobile);
//        }
//        $data = [
//            'order_item_id' => $request->input('wp_order_item_id'),
//            'bigo_id' => $request->input('bigo_id'),
//            'amount' => $request->input('amount'),
//            'value' => $request->input('value'),
//            'orderId' => $request->input('order_id'),
//            'wp_order_id' => $request->input('wp_order_id'),
//            'app_type' => $request->input('app_type') ?? EAppType::BIGO_LIVE,
//            'mobile' => $mobile ?? null,
//            'paid_date' => $request->input('paid_date'),
//        ];

//        dd($orderItem->getAttributes());
        Log::channel('requests')->info('request', $orderItem->getAttributes());
        if(($orderItem->order->getRawOriginal('status') && $orderItem->order->getRawOriginal('payment_status') == 1) ) {
            $data = [
            'order_item_id' => $orderItem->id,
            'bigo_id' => $orderItem->account_id,
            'value' => $orderItem->productVariation->value,
            'order_id' => $orderItem->order_id,
            'app_type' => $orderItem->product->app_type ?? EAppType::BIGO_LIVE,
            'mobile' => auth()->user()->cellphone ?? null,
            'paid_date' => $orderItem->order->transaction->created_at,
            ];
            return  $this->commonStoreUsing($data);
        }

        alert()->error('خطا!', 'عملیات شارژ ناموفق بود!');
        return false;
    }

    public function commonStoreUsing($data)
    {
        $orderItemId = $data['order_item_id'] ?? null;
        $bigoId = $data['bigo_id'];
        $amount = $data['amount'] ?? null;
        $value = $data['value'] ?? null;
        $orderId = $data['order_id'] ?? null;
        $appType = $data['app_type'];
        $mobile = $data['mobile'] ?? null;
        $paidDate = $data['paid_date'] ?? null;
        if (empty($bigoId)) {
            alert()->error('عملیات ناموفق', 'missed fields');
            return redirect()->back();
//            return Response::json([
//                'status' => false,
//                'message' => 'missed fields',
//            ]);
        }

        if (!empty($bigoId)) {
            $bigoId_check = DB::table('blacklists')->where('black_id', $bigoId)->first();
            if ($bigoId_check) {

                $botToken = "6420852445:AAF-LF7kN9GG9D2ruKQD-0ArY-Bvtjrt1jU";
                $chatId = "463647617";
                $url = 'https://api.telegram.org/bot' . $botToken . '/sendMessage';
                Http::post($url, ['chat_id' => $chatId, 'text' => " ایدی $bigoId در بلک لیست است شماره سفارش $orderId در تاریخ $paidDate"]);

                alert()->error('عملیات ناموفق', 'ایدی در بلاک لیست است!');
                return redirect()->back();
//                return Response::json([
//                    'message' => 'ایدی در بلاک لیست است!',
//                    'status' => false,
//                ]);
            }
        }

        if (!empty($orderItemId)) {
            $order_check = DB::table('payment_pins')->where('order_item_id', $orderItemId)->first();
            if ($order_check) {
                return Response::json([
                    'status' => false,
                ]);
            }
        }

        if (!empty($paidDate)) {
            $carbon = Carbon::parse($paidDate);
            $carbon->setTimezone(config('app.timezone'));

            if ($carbon->diffInMinutes(Carbon::now()) > 5) {
                return Response::json([
                    'status' => false,
                    'message' => 'Expired order!',
                ]);
            }
        }

        if (!empty($orderItemId)) {
            if ($this->paymentPinRepository->getPaymentPinByOrderItemId($orderItemId)) {
                return Response::json([
                    'status' => false,
                    'message' => 'duplicate order!',
                ]);
            }
        }

        if ($appType == EAppType::BIGO_LIVE) {
            $clientAPI = new BigoAPI($bigoId);
        } elseif ($appType == EAppType::LIKEE) {
            $clientAPI = new LikeeAPI($bigoId);
        }

        if (empty($clientAPI)) {
            return Response::json([
                'status' => false,
                'message' => 'client api is empty!',
            ]);
        }

        $paymentUrl = $clientAPI->getPaymentUrl();
        $paymentToken = BigoAPI::getPaymentTokenFromPaymentUrl($paymentUrl);

        if (empty($paymentToken)) {

            $botToken = "6420852445:AAF-LF7kN9GG9D2ruKQD-0ArY-Bvtjrt1jU";
            $chatId = "463647617";
            $url = 'https://api.telegram.org/bot' . $botToken . '/sendMessage';
            Http::post($url, ['chat_id' => $chatId, 'text' => "توکن غیر فعال شده شماره سفارش $orderId در تاریخ $paidDate   "]);

            alert()->error('عملیات ناموفق', 'توکن غیر فعال است !');
            return redirect()->back();
//         return Response::json([
//                'status' => false,
//                'message' => 'توکن غیر فعال است !',
//            ]);
        }

        if (!empty($amount)) {
            $paymentPin = $this->paymentPinRepository->getActivePaymentPinByAmount($amount);
            $paymentPinsCount = $this->paymentPinRepository->getActivePaymentsCountPinByAmount($amount);
        } elseif (!empty($value)) {
            $paymentPin = $this->paymentPinRepository->getActivePaymentPinByValue($value, $appType);
            $paymentPinsCount = $this->paymentPinRepository->getActivePaymentsCountPinByValue($value, $appType);
        }

        if (isset($paymentPinsCount) && $paymentPinsCount <= 5) {
            $amount = !empty($paymentPin) ? $paymentPin->amount : $amount;

            try {
                PaymentPinIsLowEvent::dispatch($amount, $value, $appType);
            } catch (Exception $exception) {
            }
        }

        if (!empty($paymentPin)) {
            $trackingCode = $clientAPI->purchase($paymentToken, $paymentPin->serial_number, $paymentPin->pin, $paymentPin->amount);

            if (!empty($trackingCode)) {
                $this->paymentPinRepository->setPaymentPinAsUsed($paymentPin, $bigoId, $orderId, $trackingCode, $appType, $mobile, orderItemId: $orderItemId);

//                if (!empty($orderId)) {
//                    $client = new Client();
//                    $url = "https://bigoplus.ir//wp-json/wc/v3/orders/{$orderId}?status=completed&consumer_key=ck_20a17bf6a7337e34abf29ebba680ac1d23caecf4&consumer_secret=cs_e18170039a767cab833decbcb5461f9c30a49b7d";
//                    $response = $client->request('POST', $url, [
//
//                    ]);
//                }

                alert()->success('شارژ موفق', 'شارژ حساب با موفقیت انجام گردید.');
                return redirect()->back();
//                return Response::json([
//                    'status' => true,
//
//                ]);
            } else {
                $this->paymentPinRepository->setPaymentPinAsRejected($paymentPin, $appType, $orderId, $mobile, orderItemId: $orderItemId);


                // todo change order status to on-hold
//                if (!empty($orderId)) {
//
//
//                    $client = new Client();
//                    $url = "https://bigoplus.ir//wp-json/wc/v3/orders/{$orderId}?status=on-hold&consumer_key=ck_20a17bf6a7337e34abf29ebba680ac1d23caecf4&consumer_secret=cs_e18170039a767cab833decbcb5461f9c30a49b7d";
//                    $response = $client->request('POST', $url, [
//
//                    ]);
//                }


                $botToken = "6420852445:AAF-LF7kN9GG9D2ruKQD-0ArY-Bvtjrt1jU";
                $chatId = "463647617";
                $url = 'https://api.telegram.org/bot' . $botToken . '/sendMessage';
                // todo uncomment before commit
                Http::post($url, ['chat_id' => $chatId, 'text' => "پین  $amount دلار نا معتبر است به شماره سفارش $orderId"]);

                alert()->error('عملیات ناموفق', 'پین نا معتبر است !');
                return redirect()->back();
//                return Response::json([
//                    'status' => false,
//                    'message' => 'پین نا معتبر است !',
//                    'mess2e' =>  $paymentPinsCount-1,
//                  'mess4e' =>  $amount,
//
//
//                ]);
            }
        }else{

            // todo change order status to on-hold if needed
//        if (!empty($orderId)) {
//
//
//            $client = new Client();
//            $url = "https://bigoplus.ir//wp-json/wc/v3/orders/{$orderId}?status=on-hold&consumer_key=ck_20a17bf6a7337e34abf29ebba680ac1d23caecf4&consumer_secret=cs_e18170039a767cab833decbcb5461f9c30a49b7d";
//            $response = $client->request('POST', $url, [
//
//            ]);
//        }


            $botToken = "6420852445:AAF-LF7kN9GG9D2ruKQD-0ArY-Bvtjrt1jU";
            $chatId = "463647617";
            $url = 'https://api.telegram.org/bot' . $botToken . '/sendMessage';
            Http::post($url, ['chat_id' => $chatId, 'text' => "پین  $amount دلاری  تمام شده است برای سفارش $orderId"]);

            alert()->error('عملیات ناموفق', 'موجودی پین تمام شد!');
//        return redirect()->back();
//        return Response::json([
//            'status' => false,
//            'message' => 'موجودی پین تمام شد',
//            'Id'=> $bigoId,
//            'mess2e' =>  $orderId,
//        ]);
        }

    }

//    public function oldStoreUsing(StoreUsingRequest $request)
//    {
//        $bigoId = $request->input('bigo_id');
//        $paymentPin = $this->paymentPinRepository->find($request->input('payment_pin_id'));
//        $appType = $request->input('app_type') ?? EAppType::BIGO_LIVE;
//
//        $amount = $paymentPin->amount;
//
//        $response = sendRequest(
//            route('api.payment-pins.using'),
//            'POST',
//            [
//                'bigo_id' => $bigoId,
//                'amount' => $amount,
//                'app_type' => $appType,
//            ]
//        );
//
//        if (!empty($response['status'])) {
//            return Redirect::back()->with([
//                'success' => 'کاربر با موفقیت شارژ شد!'
//            ]);
//        }
//
//        if (isset($response['status']) && $response['status'] == false) {
//            if (!empty($response['message'])) {
//                return Redirect::back()->with(['error' => $response['message']]);
//            }
//        }
//
//        return Redirect::back()->with(['error' => 'خطای سیستمی!']);
//    }

}
