<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Admin\BaseAdminController;
use App\Repositories\Admin\SettingRepository;

class SettingController extends BaseAdminController
{
    protected $bookingRepository;

    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    public function index()
    {
        $settings = $this->settingRepository->getSettings();
        return view('admin.setting.index', compact('settings'));
    }
}
