<?php

namespace App\Http\Controllers\Admin\RazerAccount;

use App\Http\Controllers\Controller;
use App\Models\RazerAccount;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class RazerAccountController extends Controller
{
    public function index()
    {
        $totalChargeBalance = RazerAccount::sum('charge_balance');
        $razerAccounts = RazerAccount::all();
        return view('admin.razer_account.index', compact('razerAccounts', 'totalChargeBalance'));
    }


    public function add()
    {
        return view('admin.razer_account.add');

    }

    public function edit($id)
    {
        $razerAccount = RazerAccount::find($id);

        if (!$razerAccount) {
            return redirect()->back()->withErrors(['error' => 'GiftCharge not found']);
        }

        return view('admin.razer_account.edit', [
            'razerAccount' => $razerAccount
        ]);
    }

    public function store()
    {
        $validate_data = Validator::make(request()->all(), [
            'razer_id' => 'required',
            'email_address' => 'required|email',
            'location' => 'nullable|string',
            'charge_balance' => 'required|numeric',
            'charge_ceiling' => 'nullable|numeric',
            'priority' => 'nullable|numeric',
        ])->validated();

        $validate_data['charge_ceiling'] = (int)$validate_data['charge_ceiling'] > 0 ? (int)$validate_data['charge_ceiling'] : 90000;
        $validate_data['priority'] = (int)RazerAccount::min('priority');

        $validate_data['manual_updated_at'] = now();

        RazerAccount::create($validate_data);

        return Redirect::route('admin.razer_accounts.index')->with('success', 'اکانت جدید با موفقیت ثبت شد');

    }

    public function update($id)
    {
        $validate_data = Validator::make(request()->all(), [
            'razer_id' => 'required',
            'email_address' => 'required|email',
            'location' => 'nullable|string',
            'charge_balance' => 'required|numeric',
            'charge_ceiling' => 'nullable|numeric',
            'priority' => 'nullable|numeric',
        ])->validated();

        $validate_data['charge_ceiling'] = (int)$validate_data['charge_ceiling'] > 0 ? (int)$validate_data['charge_ceiling'] : 90000;

        $razerAccount = RazerAccount::find($id);

        if ( (request('type') !== null) && (request('type') == 'manual') && ($razerAccount->charge_balance != $validate_data['charge_balance'])) {
            $razerAccount->manual_updated_at = now();
        }
        if (!$razerAccount) {
            return redirect()->back()->withErrors(['error' => 'RazerAccount not found']);
        }
        $razerAccount->update($validate_data);

        return Redirect::route('admin.razer_accounts.index')->with('success', 'اطلاعات اکانت با موفقیت بروزرسانی شد');
    }


    public function destroy($id)
    {
        $blacklist = RazerAccount::findOrFail($id);

        $blacklist->delete();

        return back()->with('success', 'اکانت با موفقیت حذف شد!');
    }
}
