<?php

namespace App\Http\Requests\Admin\State;

use App\Http\Requests\Admin\AdminBaseRequest;

class UpdateStateRequest extends AdminBaseRequest
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
            'stateable_id' => ['required'],
            'stateable_type' => ['required'],
        ];
    }
}
