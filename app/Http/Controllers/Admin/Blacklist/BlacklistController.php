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
        return view('admin.blacklist.index' , [
            'blacklist' => Blacklist::all()
        ]);

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

public function store (){
    $validate_data = Validator::make(request()->all() , [

        'name' => 'required',
        'blackid' => 'required',
        'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        'amount' => 'required',
        'Description' => 'required',
    ])->validated();




    Blacklist::create($validate_data);

return Redirect::route('admin.blacklist.index')->with('success' , 'کاربر با موفقیت در بلک لیست ثبت شد');

}

    
}