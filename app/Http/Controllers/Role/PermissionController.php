<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Permission::all();
        $roles = Role::pluck('name', 'id');
        return view('admin.admins.permissions.all', compact('records', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $record = new Permission();
        return view('admin.admins.permissions.createOrUpdate', compact('record'));
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
            'name' => 'required|unique:permissions',
//            'role_list' => 'required|array',
        ]);
        $permission = Permission::create($request->all());
//        $role = Role::where('id', [$request->input('role_list')])->get();
//        $role->givePermissionTo($permission);
        if ($request->has('Add More')){
            dd("more");
        }
        return redirect(route('permission.index'))->with('session', 'Permission Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record = Permission::findById($id);
        return view('admin.admins.permissions.createOrUpdate', compact('record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd("editcontroller");
        $request->validate([
            'name' => 'required|unique:permissions,name,'.$id,
            'role_list' => 'required',
        ]);

        $permission = Permission::findById($id);
        $permission->update($request->except('role_list'));
        $permission->syncRoles($request->input('role_list'));
        return redirect(route('permission.index'))->with('session', 'Permission Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::findById($id)->delete();
        return redirect(route('permission.index'))->with('session', 'Permission Deleted');
    }
}
