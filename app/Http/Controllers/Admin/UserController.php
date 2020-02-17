<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Profile;
use App\Enums\UserStatus;
use Illuminate\Support\Facades\Hash;


use App\Http\Requests\{StoreUserRequest, UpdateUserRequest};


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate();
        $title = 'Users Management';
        return view('admin.users.index', compact('users', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Add User';
        $status = UserStatus::toSelectArray();
        return view('admin.users.create', compact('title', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        $profile = new Profile();
        $user->profile()->save($profile);

        return redirect(route('admin.users.index'))->with('success', 'User Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.show')->withUser($user)->withTitle('Show User');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $status = UserStatus::toSelectArray();
        return view('admin.users.edit')->withUser($user)->withTitle('Edit User')->withStatus($status);
   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        
        if (!$user->profile) {
            $profile = new Profile();
            $user->profile()->save($profile);
        }
        return redirect(route('admin.users.index'))->with('success', 'User Updated Successfully!');
    }

    public function changeUserStatus(Request $request)
    {
        $user = User::find($request->user_id);
        $user->status = $request->status;
        $user->save();
  
        return response()->json(['success'=>'User status change successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index');
    }

    public function trashed()
    {
        $users = User::onlyTrashed()->paginate();
        $title = 'Trashed Users';
        return view('admin.users.trashed', compact('title', 'users'));
    }

    public function restore($id)
    {
        User::withTrashed()
            ->where('id', $id)
            ->restore();

        return redirect(route('admin.users.trashed'));
    }

    public function userDestroy($id)
    {
        $user = User::withTrashed()
                ->findOrFail($id);
        $user->forceDelete();
        return redirect()->route('admin.users.index');
    }
    
    public function force($id)
    {
        User::trash($id)->forceDelete();
        return redirect()->route('admin.users.index');
    }
}
