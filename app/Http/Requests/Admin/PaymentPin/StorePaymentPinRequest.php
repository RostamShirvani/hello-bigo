<?php

namespace App\Http\Requests\Admin\PaymentPin;

use App\Http\Requests\Admin\AdminBaseRequest;

class StorePaymentPinRequest extends AdminBaseRequest
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
        $type = $this->input('type') ?? 'single';

        if ($type === 'bulk') {
            return [
                'items' => ['required', 'array', 'min:1'],
                'items.*' => ['required', 'array'],
                'items.*.serial_number' => ['nullable', 'unique:payment_pins,serial_number'],
                'items.*.pin' => ['nullable', 'unique:payment_pins,pin'],
                'items.*.amount' => ['nullable', 'numeric'],
                'items.*.value' => ['nullable', 'numeric'],
                'items.*.likee_value' => ['nullable', 'numeric'],
            ];
        } elseif ($type === 'file') {
            return [
                'file' => ['required'],
                'amount' => ['required', 'numeric'],
                'value' => ['required', 'numeric'],
                'likee_value' => ['required', 'numeric'],
            ];
        }

        return [
            'serial_number' => ['required', 'unique:payment_pins,serial_number'],
            'pin' => ['required', 'unique:payment_pins,pin'],
            'amount' => ['required', 'numeric'],
            'value' => ['required', 'numeric'],
            'likee_value' => ['required', 'numeric'],
        ];
    }
}
