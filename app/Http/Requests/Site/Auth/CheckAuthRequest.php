<?php

namespace App\Http\Requests\Site\Auth;

use App\Http\Requests\Site\SiteBaseRequest;
use App\Rules\IranianMobileNumber;
use Illuminate\Validation\Rule;

class CheckAuthRequest extends SiteBaseRequest
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
            'mobile' => ['required', 'exists:users,bigo_id'],
        ];
    }

    public function attributes()
    {
        return [
            'mobile' => __trans('site/booking', 'mobile'),
        ];
    }
}
