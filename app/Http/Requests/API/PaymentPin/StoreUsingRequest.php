<?php

namespace App\Http\Requests\API\PaymentPin;

use App\Enums\EAppType;
use App\Http\Requests\API\APIBaseRequest;
use Illuminate\Validation\Rule;

class StoreUsingRequest extends APIBaseRequest
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
            'amount' => ['nullable'],
            'value' => ['nullable'],
            'app_type' => ['nullable', Rule::in(EAppType::toArray())],
            'wp_order_id' => [
                'nullable',
                Rule::unique('payment_pins')
                    ->where('wp_order_id', $this->input('wp_order_id'))
                    ->where('wp_order_item_id', $this->input('wp_order_item_id'))
            ],
            'order_id' => [
                'nullable',
                'unique:payment_pins,order_id',
            ],
        ];
    }
}
