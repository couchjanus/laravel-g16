<?php

namespace App\Http\Controllers\Admin;

use App\{Admin, Role};
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\UserStatus;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\{StoreAdminRequest, UpdateAdminRequest};

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Admin::orderBy('id', 'desc')->paginate();
        $title = 'Employees Management';
        return view('admin.admins.index', compact('users', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Add Employee';
        $roles = Role::all()->pluck('name', 'id');
        $status = UserStatus::toSelectArray();
        return view('admin.admins.create', compact('title', 'status', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Admin::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        return redirect(route('admin.admins.index'))->with('success', 'Employee Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        // abort_unless(\Gate::allows('user-edit'), 403);
        $title = 'Edit Employee';
        $roles = Role::all()->pluck('name', 'id');
        $admin->load('roles');
        $status = UserStatus::toSelectArray();
        return view('admin.admins.edit', compact('title', 'roles', 'status', 'admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        // abort_unless(\Gate::allows('user-edit'), 403);
        $admin->update($request->all());
        $admin->roles()->sync((array)$request->input('roles'));
        return redirect(route('admin.admins.index'))->with('success', 'User Updated Successfully!');

    }

    public function changeUserStatus(Request $request)
    {
        $user = Admin::find($request->user_id);
        $user->status = $request->status;
        $user->save();
  
        return response()->json(['success'=>'User status change successfully.']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }

    public function trashed()
    {
        $users = Admin::onlyTrashed()->paginate();
        $title = 'Trashed Users';
        return view('admin.admins.trashed', compact('title', 'users'));
    }

    public function restore($id)
    {
        Admin::withTrashed()
            ->where('id', $id)
            ->restore();

        return redirect(route('admin.admins.trashed'));
    }

    public function userDestroy($id)
    {
        $user = Admin::withTrashed()
                ->findOrFail($id);
        $user->forceDelete();
        return redirect()->route('admin.admins.index');
    }
    
    public function force($id)
    {
        Admin::trash($id)->forceDelete();
        return redirect()->route('admin.admins.index');
    }
}
