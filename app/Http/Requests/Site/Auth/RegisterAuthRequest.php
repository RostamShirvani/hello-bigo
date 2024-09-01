<?php

namespace App\Http\Requests\Site\Auth;

use App\Http\Requests\Site\SiteBaseRequest;
use App\Rules\IranianMobileNumber;

class RegisterAuthRequest extends SiteBaseRequest
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
            'mobile' => ['required', new IranianMobileNumber(), 'unique:users,mobile'],
            'name' => ['required', 'string', 'min:2', 'max:100'],
            'surname' => ['required', 'string', 'min:2', 'max:100'],
            'otp' => ['required', 'digits:4'],
        ];
    }

    public function attributes()
    {
        return [
            'mobile' => __trans('site/auth', 'mobile'),
            'name' => __trans('site/auth', 'name'),
            'surname' => __trans('site/auth', 'surname'),
            'otp' => __trans('site/auth', 'otp'),
        ];
    }
}
