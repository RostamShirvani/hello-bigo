<?php

namespace App\Http\Controllers\Admin\GiftCharge;

use App\Http\Controllers\Controller;
use App\Models\GiftCharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class GiftChargeController extends Controller
{
    public function index()
    {
        return view('admin.gift_charge.index', [
            'giftCharges' => GiftCharge::all()
        ]);

    }


    public function add()
    {
        return view('admin.gift_charge.add');

    }

    public function edit($id)
    {
        $giftCharge = GiftCharge::find($id);

        if (!$giftCharge) {
            return redirect()->back()->withErrors(['error' => 'GiftCharge not found']);
        }

        return view('admin.gift_charge.edit', [
            'giftCharge' => $giftCharge
        ]);
    }

    public function store()
    {
        $validate_data = Validator::make(request()->all(), [
            'razer_id' => 'required',
            'email_address' => 'required|email',
            'total_charge_balance' => 'required|numeric',
            'charge_ceiling' => 'nullable|numeric', // Allow charge_ceiling to be optional
        ])->validated();

        $validate_data['charge_ceiling'] = (int)$validate_data['charge_ceiling'] > 0 ? (int)$validate_data['charge_ceiling'] : 90000;
        $validate_data['charge_ceil_flag'] = (int)GiftCharge::min('charge_ceil_flag');

        GiftCharge::create($validate_data);

        return Redirect::route('admin.gift_charge.index')->with('success', 'اکانت جدید با موفقیت ثبت شد');

    }

    public function update($id)
    {
        $validate_data = Validator::make(request()->all(), [
            'razer_id' => 'required',
            'email_address' => 'required|email',
            'total_charge_balance' => 'required|numeric',
            'charge_ceiling' => 'nullable|numeric', // Allow charge_ceiling to be optional
        ])->validated();

        $validate_data['charge_ceiling'] = (int)$validate_data['charge_ceiling'] > 0 ? (int)$validate_data['charge_ceiling'] : 90000;

        $giftCharge = GiftCharge::find($id);

        if (!$giftCharge) {
            return redirect()->back()->withErrors(['error' => 'GiftCharge not found']);
        }
        $giftCharge->update($validate_data);

        return Redirect::route('admin.gift_charge.index')->with('success', 'اطلاعات اکانت با موفقیت بروزرسانی شد');
    }


    public function destroy($id)
    {
        $blacklist = GiftCharge::findOrFail($id);

        $blacklist->delete();

        return back()->with('success', 'اکانت با موفقیت حذف شد!');
    }
}