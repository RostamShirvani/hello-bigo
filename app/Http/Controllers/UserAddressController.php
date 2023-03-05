<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class UserAddressController extends Controller
{
    public function index()
    {
        $provinces = Province::all();
        return view('home.users_profile.addresses', compact('provinces'));
    }

    public function store(Request $request)
    {
        $request->validateWithBag('addressStore',[
           'title' => 'required',
           'cellphone' => 'required|iran_mobile',
           'province_id' => 'required',
           'city_id' => 'required',
           'address' => 'required',
           'postal_code' => 'required|iran_postal_code',
        ]);
        UserAddress::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'cellphone' => $request->cellphone,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'address' => $request->address,
            'postal_code' => $request->postal_code,
        ]);
        alert()->success( 'با تشکر', 'آدرس مورد نظر ایجاد شد.');
        return redirect()->route('home.addresses.index');
    }

    public function getProvinceCitiesList(Request $request)
    {
        $cities = City::query()->where('province_id', $request->province_id)->get();
        return $cities;
    }
}
