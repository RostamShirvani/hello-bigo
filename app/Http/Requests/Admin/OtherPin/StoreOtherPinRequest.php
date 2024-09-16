<?php

namespace App\Http\Requests\Admin\OtherPin;

use App\Http\Requests\Admin\AdminBaseRequest;

class StoreOtherPinRequest extends AdminBaseRequest
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
                'items.*.app_type' => ['required', 'numeric'],
                'items.*.pin' => ['nullable', 'unique:other_pins,pin'],
                'items.*.amount' => ['nullable', 'numeric'],
                'items.*.value' => ['nullable', 'numeric'],
            ];
        } elseif ($type === 'file') {
            return [
                'file' => ['required'],
                'app_type' => ['required', 'numeric'],
                'amount' => ['required', 'numeric'],
                'value' => ['required', 'numeric'],
            ];
        }

        return [
            'app_type' => ['required', 'numeric'],
            'pin' => ['required', 'unique:payment_pins,pin'],
            'amount' => ['required', 'numeric'],
            'value' => ['required', 'numeric'],
        ];
    }
}
