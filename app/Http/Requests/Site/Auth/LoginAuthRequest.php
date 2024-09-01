<?php

namespace App\Http\Requests\Site\Auth;

use App\Http\Requests\Site\SiteBaseRequest;
use App\Rules\IranianMobileNumber;

class LoginAuthRequest extends SiteBaseRequest
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
            'mobile' => ['required'],
            'otp' => ['required', 'digits:6'],
        ];
    }

    public function attributes()
    {
        return [
            'mobile' => __trans('site/auth', 'mobile'),
            'otp' => __trans('site/auth', 'otp'),
        ];
    }
}
