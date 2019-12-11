<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $records = User::with('roles', 'permissions')->get();
        return view('admin/admins/users.all', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $record = new User();
        return view('admin.admins.users.createOrUpdate', compact('record'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required|min:8',
            'email' => 'required|email|unique:users',
            'role_list' => 'required|array',
            'permission_list' => 'required|array',
        ]);

        $request->merge(['password' => Hash::make($request->input('password'))]);
        $user = User::create($request->except('role_list', 'permission_list'));
        $user->assignRole($request->input('role_list'));
        $user->givePermissionTo($request->input('permission_list'));
        return redirect(route('admin.index'))->with('success', 'User Created');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $record = User::find($id);
        return view('admin.admins.users.createOrUpdate', compact('record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'role_list' => 'required|array',
            'permission_list' => 'required|array',
        ]);

        $user = User::find($id);
        if ($request->input('active')) {
            $user->update(['active' => 0]);
            return redirect(route('admin.index'))->with('danger', 'User Banned');
        } else {
            $user->update(['active' => 1]);
        }
        $user->update($request->except('role_list', 'permission_list', 'status', 'password'));
        $user->syncRoles($request->input('role_list'));
        $user->syncPermissions($request->input('permission_list'));
        return redirect(route('admin.index'))->with('success', 'User Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::find($id)->delete();
        return redirect(route('admin.index'))->with('warning', 'User Deleted');
    }
}
