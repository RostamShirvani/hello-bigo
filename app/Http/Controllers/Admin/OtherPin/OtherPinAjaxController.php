<?php

namespace App\Http\Controllers\Admin\PaymentPin;

use App\Http\Controllers\Admin\BaseAdminController;
use App\Repositories\Admin\PaymentPinRepository;
use Illuminate\Support\Facades\Response;

class OtherPinAjaxController extends BaseAdminController
{
    protected $paymentPinRepository;

    public function __construct(PaymentPinRepository $paymentPinRepository)
    {
        $this->paymentPinRepository = $paymentPinRepository;
    }
}
