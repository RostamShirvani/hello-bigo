<?php

namespace App\Http\Controllers\Admin\PaymentPin;

use App\Enums\EAppType;
use App\Events\PaymentPinIsLowEvent;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Admin\PaymentPin\StorePaymentPinRequest;
use App\Http\Requests\Admin\PaymentPin\StoreUsingRequest;
use App\Models\OrderItem;
use App\Models\PaymentPin\PaymentPin;
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

        $result = $this->commonStoreUsing($data);
        if (!blank($result['status'])) {
            if ($result['status'] == OrderItem::STATUS_CHARGED) {
                alert()->success('عملیات موفق', $result['message'] ?? '');
                return redirect()->back();
            } else {
                alert()->error('عملیات ناموفق', $result['message'] ?? '');
                return redirect()->back();
            }
        }
        alert()->error('عملیات ناموفق', 'عملیات شارژ با خطا مواجه شد!');
        return redirect()->back();
    }

    // Do charge from shop
    public function storeUsingAfterPay($orderItem)
    {
        Log::channel('requests')->info('request', $orderItem->getAttributes());
        if (($orderItem->order->getRawOriginal('payment_status') == 1)) {
            $data = [
                'order_item_id' => $orderItem->id,
                'bigo_id' => $orderItem->account_id,
                'value' => $orderItem->productVariation->value,
                'order_id' => $orderItem->order_id,
                'app_type' => $orderItem->product->app_type ?? EAppType::BIGO_LIVE,
                'mobile' => auth()->user()->cellphone ?? null,
                'paid_date' => $orderItem->order->transaction->created_at,
            ];
            return $this->commonStoreUsing($data);
        }

        return [
            'status' => OrderItem::STATUS_UNKNOWN,
            'message' => 'عملیات شارژ با خطا مواجه شد!',
        ];
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
            return [
                'status' => OrderItem::STATUS_MISSED_FIELDS,
                'message' => 'Missed field bigo_id !',
            ];
        }

        if (!empty($bigoId)) {
            $bigoId_check = DB::table('blacklists')->where('black_id', $bigoId)->first();
            if ($bigoId_check) {

                $botToken = "6420852445:AAF-LF7kN9GG9D2ruKQD-0ArY-Bvtjrt1jU";
                $chatId = "463647617";
                $url = 'https://api.telegram.org/bot' . $botToken . '/sendMessage';
                Http::post($url, ['chat_id' => $chatId, 'text' => " ایدی $bigoId در بلک لیست است شماره سفارش $orderId در تاریخ $paidDate"]);
                return [
                    'status' => OrderItem::STATUS_BLACKLIST,
                    'message' => 'آیدی در بلاک لیست است!',
                ];
            }
        }

//        if (!empty($paidDate)) {
//            $carbon = Carbon::parse($paidDate);
//            $carbon->setTimezone(config('app.timezone'));
//
//            if ($carbon->diffInMinutes(Carbon::now()) > 5) {
//                return Response::json([
//                    'status' => false,
//                    'message' => 'Expired order!',
//                ]);
//            }
//        }

        if (!empty($orderItemId)) {
            if ($this->paymentPinRepository->getPaymentPinByOrderItemId($orderItemId)) {
                return [
                    'status' => OrderItem::STATUS_DUPLICATE,
                    'message' => 'آیتم سفارش تکراری است!',
                ];
            }
        }

        if ($appType == EAppType::BIGO_LIVE) {
            $clientAPI = new BigoAPI($bigoId);
        } elseif ($appType == EAppType::LIKEE) {
            $clientAPI = new LikeeAPI($bigoId);
        }

        if (empty($clientAPI)) {
            return [
                'status' => OrderItem::STATUS_EMPTY_CLIENT_API,
                'message' => 'client api is empty!',
            ];
        }

        $paymentUrl = $clientAPI->getPaymentUrl();
        $paymentToken = BigoAPI::getPaymentTokenFromPaymentUrl($paymentUrl);

        if (empty($paymentToken)) {

            $botToken = "6420852445:AAF-LF7kN9GG9D2ruKQD-0ArY-Bvtjrt1jU";
            $chatId = "463647617";
            $url = 'https://api.telegram.org/bot' . $botToken . '/sendMessage';
            Http::post($url, ['chat_id' => $chatId, 'text' => "توکن غیر فعال شده شماره سفارش $orderId در تاریخ $paidDate   "]);

            return [
                'status' => OrderItem::STATUS_TOKEN_INACTIVE,
                'message' => 'توکن غیر فعال است !',
            ];
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

                return [
                    'status' => OrderItem::STATUS_CHARGED,
                    'message' => 'شارژ حساب با موفقیت انجام گردید.',
                ];
            } else {
                $this->paymentPinRepository->setPaymentPinAsRejected($paymentPin, $appType, $orderId, $mobile, orderItemId: $orderItemId);

                $botToken = "6420852445:AAF-LF7kN9GG9D2ruKQD-0ArY-Bvtjrt1jU";
                $chatId = "463647617";
                $url = 'https://api.telegram.org/bot' . $botToken . '/sendMessage';
                // todo uncomment before commit
                Http::post($url, ['chat_id' => $chatId, 'text' => "پین  $amount دلار نا معتبر است به شماره سفارش $orderId"]);

                return [
                    'status' => OrderItem::STATUS_PIN_INVALID,
                    'message' => 'پین نا معتبر است !',
                ];
            }
        } else {
            $botToken = "6420852445:AAF-LF7kN9GG9D2ruKQD-0ArY-Bvtjrt1jU";
            $chatId = "463647617";
            $url = 'https://api.telegram.org/bot' . $botToken . '/sendMessage';
            Http::post($url, ['chat_id' => $chatId, 'text' => "پین  $amount دلاری  تمام شده است برای سفارش $orderId"]);
            return [
                'status' => OrderItem::STATUS_PIN_FINISHED,
                'message' => 'موجودی پین تمام شد!',
            ];
        }

    }
    public function toggleState(Request $request, $id)
    {
        $paymentPin = PaymentPin::findOrFail($id);

        // Get new state from the request
        $newState = $request->input('state');

        // Validate the new state
        if (!in_array($newState, [1, 2])) {
            return response()->json(['success' => false, 'message' => 'Invalid state'], 400);
        }

        // Update state and save
        $paymentPin->state = $newState;
        $paymentPin->save();

        // Return the new state in the response
        return response()->json([
            'success' => true,
            'newState' => $paymentPin->state
        ]);
    }
}
