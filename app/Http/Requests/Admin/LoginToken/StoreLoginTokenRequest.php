<?php

namespace App\Http\Requests\Admin\LoginToken;

use App\Http\Requests\Admin\AdminBaseRequest;

class StoreLoginTokenRequest extends AdminBaseRequest
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
            'verification_code' => ['required'],
        ];
    }
}
