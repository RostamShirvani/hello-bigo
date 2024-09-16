<?php

namespace App\Http\Requests\Admin\OtherPin;

use App\Http\Requests\Admin\AdminBaseRequest;

class UpdateOtherPinRequest extends AdminBaseRequest
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
            'order_id' => ['required', 'numeric'],
            'order_item_id' => ['required', 'numeric'],
        ];
    }
}
