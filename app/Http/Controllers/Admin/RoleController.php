<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::query()->latest()->paginate(20);
        return view('admin.roles.index', compact('roles'));
    }

    public function show(Role $role)
    {
        return view('admin.roles.show', compact('role'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'display_name' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $role = Role::create([
                "name" => $request->name,
                "display_name" => $request->display_name,
                "guard_name" => 'web'
            ]);
            $permissions = $request->except(['_token', 'name', 'display_name']);
            $role->givePermissionTo($permissions);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error('مشکل در ایجاد نقش', $e->getMessage())->persistent('حله');
            return redirect()->back();
        }
        alert()->success('با تشکر', 'نقش مورد نظر ایجاد شد.');
        return redirect()->route('admin.roles.index');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role','permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required',
            'display_name' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $role->update([
                "name" => $request->name,
                "display_name" => $request->display_name
            ]);
            $permissions = $request->except(['_token', '_method', 'name', 'display_name']);
            $role->syncPermissions($permissions);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error('مشکل در ویرایش نقش', $e->getMessage())->persistent('حله');
            return redirect()->back();
        }
        alert()->success('با تشکر', 'نقش مورد نظر ویرایش شد.');
        return redirect()->route('admin.roles.index');
    }

}
