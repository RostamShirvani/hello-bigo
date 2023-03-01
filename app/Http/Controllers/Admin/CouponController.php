<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::query()->latest()->paginate(20);
        return view('admin.coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           'name' => 'required',
           'code' => 'required|unique:coupons,code',
           'type' => 'required',
           'amount' => 'required_if:type,=,amount',
           'percentage' => 'required_if:type,=,percentage|integer|between:0,100',
           'max_percentage_amount' => 'required_if:type,=,percentage',
           'expired_at' => 'required',
        ]);
        Coupon::create([
            'name' => $request->name ,
            'code' => $request->code ,
            'type' => $request->type ,
            'amount' => $request->amount ,
            'percentage' => $request->percentage ,
            'max_percentage_amount' => $request->max_percentage_amount ,
            'expired_at' => convertShamsiToGregorianDate($request->expired_at) ,
            'description' => $request->description ,
        ]);
        alert()->success( 'با تشکر', 'کوپن مورد نظر ایجاد شد.');
        return redirect()->route('admin.coupons.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        return view('admin.coupons.show', compact('coupon'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
           'name' => 'required',
           'code' => 'required|unique:coupons,code,'.$coupon->id,
           'type' => 'required',
           'amount' => 'required_if:type,=,amount',
           'percentage' => 'required_if:type,=,percentage|integer|between:0,100',
           'max_percentage_amount' => 'required_if:type,=,percentage',
           'expired_at' => 'required',
        ]);
        $coupon->update([
            'name' => $request->name ,
            'code' => $request->code ,
            'type' => $request->type ,
            'amount' => $request->amount ,
            'percentage' => $request->percentage ,
            'max_percentage_amount' => $request->max_percentage_amount ,
            'expired_at' => convertShamsiToGregorianDate($request->expired_at) ,
            'description' => $request->description ,
        ]);
        alert()->success( 'با تشکر', 'کوپن مورد نظر ویرایش شد.');
        return redirect()->route('admin.coupons.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
