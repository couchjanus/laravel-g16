<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // abort_unless(\Gate::allows('permission-access'), 403);
        $title = "Permissions Management";
        $permissions = Permission::latest()->paginate(5);
        return view('admin.permissions.index', compact('permissions','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Add New Permission";
        // abort_unless(\Gate::allows('permission-create'), 403);
        return view('admin.permissions.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // abort_unless(\Gate::allows('permission-create'), 403);
        Permission::create($request->all());
        return redirect()->route('admin.permissions.index')->withSuccess('Permission created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
         // abort_unless(\Gate::allows('permission-show'), 403);
         return view('admin.permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        // abort_unless(\Gate::allows('permission-edit'), 403);
        // $permission = Permission::findOrFail($permission->id);
        $title = "Edit Permission";
        return view('admin.permissions.edit', compact('permission', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        // abort_unless(\Gate::allows('permission-edit'), 403);
        $permission->update($request->all());
        return redirect()->route('admin.permissions.index')->with('success','Permission update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        // abort_unless(\Gate::allows('permission-delete'), 403);
        $permission->delete();
        return redirect()->route('admin.permissions.index')
                        ->with('success','Permission deleted successfully');
    }
}
