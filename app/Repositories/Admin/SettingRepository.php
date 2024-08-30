<?php

namespace App\Repositories\Admin;

use App\Models\Setting\Setting;

class SettingRepository extends BaseAdminRepository
{
    public function getSettings()
    {
        return Setting::query()
            ->select([
                'id',
                'key',
                'value',
            ])
            ->get();
    }

    public function edit($request)
    {
        $key = $request->input('key');
        $value = $request->input('value');

        if (empty($key)) {
            return true;
        }

        $explode = explode(',', $value);

        $item = Setting::query()
            ->where('key', $key)
            ->first();

        $item->value = json_encode($explode);
        $item->save();

        return true;
    }
}
