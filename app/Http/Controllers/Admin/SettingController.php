<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        $setting = Setting::get();
        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        // Custom validation logic
        $validated = $request->validate([
            'token' => 'required|string',
            'sms_channel' => 'required|integer',
        ]);
        // Custom validation for gateways: at least one must be checked
        if (!$request->has('zarinpal_gateway') && !$request->has('zibal_gateway')) {
            return redirect()->back()->withErrors(['gateway' => 'حداقل یک درگاه پرداخت را انتخاب نمایید.'])->withInput();
        }
        // Assuming you have a Setting model and you're updating a specific record
        $setting = Setting::get();  // or fetch specific setting based on some condition
        $setting->token = $validated['token'];
        $setting->zarinpal_gateway = $request->has('zarinpal_gateway');
        $setting->zibal_gateway = $request->has('zibal_gateway');
        $setting->sms_channel = $validated['sms_channel'];

        $setting->save();

        alert()->success('عملیات موفق', 'تنظیمات با موفقیت ذخیره شد.');
        return redirect()->back();
    }

}
