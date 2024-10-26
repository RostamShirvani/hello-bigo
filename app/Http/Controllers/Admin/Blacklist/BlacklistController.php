<?php

namespace App\Http\Controllers\Admin\Blacklist;

use App\Http\Controllers\Controller;
use App\Models\Blacklist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class BlacklistController extends Controller
{
    public function index()
    {
        $blacklist = Blacklist::all();
        return view('admin.blacklist.index' , compact('blacklist'));

    }

    public function add()
    {
        return view('admin.blacklist.add');

    }

    public function edit()
    {
        return view('admin.blacklist.edit' , [
            'blacklist' => Blacklist::all()
        ]);

    }
//TEST
public function store (){
    $validate_data = Validator::make(request()->all() , [
        'name' => 'required',
        'black_id' => 'required',
        'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:blacklists',
        'amount' => 'required',
        'description' => 'required',
    ])->validated();

    Blacklist::create($validate_data);

return Redirect::route('admin.blacklist.index')->with('success' , 'کاربر با موفقیت در بلک لیست ثبت شد');

}

}
