<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // abort_unless(\Gate::allows('role-access'), 403);
        $roles = Role::paginate();
        $title = "Roles Management";
        return view('admin.roles.index', compact('roles', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // abort_unless(\Gate::allows('role-create'), 403);
        $title = "Add New Role";
        $permissions = Permission::all(); //->pluck('name', 'id');
        return view('admin.roles.create', compact('permissions', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // abort_unless(\Gate::allows('role-create'), 403);
        $role = Role::create($request->all());
        $role->permissions()->sync($request->input('permissions', []));
        return redirect()->route('admin.roles.index')->with('success','Role created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        // abort_unless(\Gate::allows('role-show'), 403);
        $role->load('permissions');
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        // abort_unless(\Gate::allows('role-edit'), 403);
        $title = "Edit Role";
        $permissions = Permission::all()->pluck('name', 'id');
        // $role->load('permissions');
        return view('admin.roles.edit', compact('permissions', 'role', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        // abort_unless(\Gate::allows('role-edit'), 403);
      
        $role->update($request->all());
        $role->permissions()->sync((array)$request->input('permissions'));
        return redirect()->route('admin.roles.index')->with('success','Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
         // abort_unless(\Gate::allows('role-delete'), 403);
         $role->delete();
         return redirect()->route('admin.roles.index')->with('success','Role deleted successfully');
    }

    public function massDestroy(Request $request)
    {
        Role::whereIn('id', request('ids'))->delete();
        return response(null, 204);
    }
}
