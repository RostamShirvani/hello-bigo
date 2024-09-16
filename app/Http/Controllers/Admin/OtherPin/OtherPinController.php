<?php

namespace App\Http\Controllers\Admin\OtherPin;

use App\Enums\EAppType;
use App\Events\PaymentPinIsLowEvent;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Admin\OtherPin\StoreOtherPinRequest;
use App\Http\Requests\Admin\OtherPin\UpdateOtherPinRequest;
use App\Http\Requests\Admin\PaymentPin\StoreUsingRequest;
use App\Models\OrderItem;
use App\Models\OtherPin\OtherPin;
use App\Repositories\Admin\OtherPinRepository;
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

class OtherPinController extends BaseAdminController
{
    protected $bookingRepository;

    public function __construct(OtherPinRepository $otherPinRepository)
    {
        $this->otherPinRepository = $otherPinRepository;
    }

    public function index(Request $request)
    {
        $otherPins = $this->otherPinRepository->getOtherPins();
        return view('admin.other_pin.index', compact('otherPins'));
    }

    public function create(Request $request)
    {
        if ($request->input('type') === 'bulk') {
            return view('admin.other_pin.bulk');
        } elseif ($request->input('type') === 'file') {
            return view('admin.other_pin.file');
        }

        return view('admin.other_pin.create');
    }

    public function store(StoreOtherPinRequest $request)
    {
        $type = $request->input('type') ?? 'single';

        if ($type === 'bulk') {
            $otherPins = $this->otherPinRepository->bulkStore($request);

            if (empty($otherPins)) {
                return Redirect::back()->with([
                    'error' => __trans('admin/general', 'failed-insert'),
                ]);
            }
        } elseif ($type === 'file') {
            $otherPins = $this->otherPinRepository->fileStore($request);

            if (empty($otherPins)) {
                return Redirect::back()->with([
                    'error' => __trans('admin/general', 'failed-insert'),
                ]);
            }
        } else {
            $otherPin = $this->otherPinRepository->store($request);
        }

        return Redirect::route('admin.other-pins.index')->with([
            'success' => __trans('admin/general', 'success-insert'),
        ]);
    }

    public function update(UpdateOtherPinRequest $request, $id)
    {
        // Log incoming request data
        Log::info('Updating otherPin with ID: ' . $id);
        Log::info('Data:', $request->all());

        // Perform the update (make sure this works)
        try {
            $this->otherPinRepository->update($request, $id);
            Log::info('Update successful for ID: ' . $id);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => __trans('admin/general', 'success-insert'),
                ]);
            }

            return Redirect::route('admin.other-pins.index')->with([
                'success' => __trans('admin/general', 'success-insert'),
            ]);
        } catch (\Exception $e) {
            Log::error('Update failed for ID: ' . $id, ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Update failed: ' . $e->getMessage(),
            ], 500);
        }
    }


    public function using()
    {
        $otherPins = $this
            ->otherPinRepository
            ->getActivePaymentPins()
            ->unique(['amount'])
            ->sortBy('amount', SORT_ASC);


        return view('admin.other_pin.using', compact('otherPins'));
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
        if (($orderItem->order->getRawOriginal('other_status') == 1)) {
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
            if ($this->otherPinRepository->getPaymentPinByOrderItemId($orderItemId)) {
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

        $otherUrl = $clientAPI->getPaymentUrl();
        $otherToken = BigoAPI::getPaymentTokenFromPaymentUrl($otherUrl);

        if (empty($otherToken)) {

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
            $otherPin = $this->otherPinRepository->getActivePaymentPinByAmount($amount);
            $otherPinsCount = $this->otherPinRepository->getActivePaymentsCountPinByAmount($amount);
        } elseif (!empty($value)) {
            $otherPin = $this->otherPinRepository->getActivePaymentPinByValue($value, $appType);
            $otherPinsCount = $this->otherPinRepository->getActivePaymentsCountPinByValue($value, $appType);
        }

        if (isset($otherPinsCount) && $otherPinsCount <= 5) {
            $amount = !empty($otherPin) ? $otherPin->amount : $amount;

            try {
                PaymentPinIsLowEvent::dispatch($amount, $value, $appType);
            } catch (Exception $exception) {
            }
        }

        if (!empty($otherPin)) {
            $trackingCode = $clientAPI->purchase($otherToken, $otherPin->serial_number, $otherPin->pin, $otherPin->amount);

            if (!empty($trackingCode)) {
                $this->otherPinRepository->setPaymentPinAsUsed($otherPin, $bigoId, $orderId, $trackingCode, $appType, $mobile, orderItemId: $orderItemId);

                return [
                    'status' => OrderItem::STATUS_CHARGED,
                    'message' => 'شارژ حساب با موفقیت انجام گردید.',
                ];
            } else {
                $this->otherPinRepository->setPaymentPinAsRejected($otherPin, $appType, $orderId, $mobile, orderItemId: $orderItemId);

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
        $paymentPin = OtherPin::findOrFail($id);

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
