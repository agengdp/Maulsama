<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin/user/user', [
          'heading' => 'Users',
          'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'id');

        return view('admin/user/create', [
            'heading' => 'Create New User',
            'roles'   => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        'name'      => 'bail|required|min:2',
        'email'     => 'required|email|unique:users',
        'bio'       => 'required',
        'password'  => 'required|min:6',
        'role'     => 'required'
      ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->bio = $request->bio;
        $user->password = bcrypt($request->password);

        if ($user->save()) {
            // attach roles
            $user->attachRole($request->role);
            flash('User has been created');
        } else {
            flash()->error('Unable to create user');
        }

        return redirect()->route('users.index');
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
        $user = User::find($id);
        $roles = Role::pluck('name', 'id');

        return view('admin/user/edit', [
            'heading' => 'Edit : '. $user->name,
            'user'    => $user,
            'roles'   => $roles,
        ]);
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
        $this->validate($request, [
            'name'  => 'bail|required|min:2',
            'email' => 'required|email|unique:users,email,'. $id,
            'role' => 'required'
        ]);

        $user = User::findOrFail($id);

        $user->fill($request->except('role', 'password'));

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        if ($user->save()) {
            $user->roles()->sync($request->role);
            flash('User has been updated');
        } else {
            flash('Cannot update the user');
        }

        return redirect()->route('users.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->id ==$id) {
            flash()->warning('Deletion of currently logged in user is not allowed :O')->important();
            return redirect()->back();
        }

        $user = User::findOrFail($id);

        // return nya selalu null
        // karena method delete() telah di override oleh entrust
        // yang jadi tidak ada return nya alias null
        // Jancok entrust.
        // if ($user->delete()) {
        //     flash()->success('User has been deleted');
        // } else {
        //     flash()->error('Cannot delete user');
        // }
        //

        $user->delete();
        flash()->success('User has been deleted');

        return redirect()->route('users.index');
    }
}
