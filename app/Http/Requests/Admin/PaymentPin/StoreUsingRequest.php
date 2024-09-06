<?php

namespace App\Http\Requests\Admin\PaymentPin;

use App\Enums\EAppType;
use App\Http\Requests\Admin\AdminBaseRequest;
use Illuminate\Validation\Rule;

class StoreUsingRequest extends AdminBaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'bigo_id' => ['required'],
//            'payment_pin_id' => ['required', 'exists:payment_pins,id'],
            'app_type' => ['nullable', Rule::in(EAppType::toArray())]
        ];
    }
}
