<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Admin\Setting\UpdateSettingRequest;
use App\Repositories\Admin\SettingRepository;
use Illuminate\Support\Facades\Response;

class SettingAjaxController extends BaseAdminController
{
    protected $settingRepository;

    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    public function update(UpdateSettingRequest $request) {
        $this->settingRepository->edit($request);

        return Response::json([
            'status' => true,
            'message' => [
                'title' => __trans('admin/general', 'success-operation'),
                'body' => __trans('admin/general', 'success-insert'),
            ]
        ]);
    }
}
