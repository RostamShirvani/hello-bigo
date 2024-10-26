<?php

namespace App\Http\Requests\Site\Auth;

use App\Http\Requests\Site\SiteBaseRequest;

class LogoutAuthRequest extends SiteBaseRequest
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
        ];
    }

    public function attributes()
    {
        return [
        ];
    }
}
