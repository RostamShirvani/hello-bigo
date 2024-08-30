<?php

namespace App\Http\Controllers\Admin\PaymentPin;

use App\Enums\EAppType;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Admin\PaymentPin\StorePaymentPinRequest;
use App\Http\Requests\Admin\PaymentPin\StoreUsingRequest;
use App\Repositories\Admin\PaymentPinRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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

    public function storeUsing(StoreUsingRequest $request)
    {
        $bigoId = $request->input('bigo_id');
        $paymentPin = $this->paymentPinRepository->find($request->input('payment_pin_id'));
        $appType = $request->input('app_type') ?? EAppType::BIGO_LIVE;

        $amount = $paymentPin->amount;

        $response = sendRequest(
            route('api.payment-pins.using'),
            'POST',
            [
                'bigo_id' => $bigoId,
                'amount' => $amount,
                'app_type' => $appType,
            ]
        );

        if (!empty($response['status'])) {
            return Redirect::back()->with([
                'success' => 'کاربر با موفقیت شارژ شد!'
            ]);
        }

        if (isset($response['status']) && $response['status'] == false) {
            if (!empty($response['message'])) {
                return Redirect::back()->with(['error' => $response['message']]);
            }
        }

        return Redirect::back()->with(['error' => 'خطای سیستمی!']);
    }
}
