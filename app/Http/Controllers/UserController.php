<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {

        $users = User::all();
        $users -> load('roles');
        return view('users.index', compact('users'));
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->roles()->detach();
        $user->delete();
        return redirect()->route('users.index');
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $user -> load("roles");
        return view('users.edit', compact('user', 'roles'));
    }


    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        foreach ($request as $role) {
            if ($user->hasRoles($role->input('roles'))) {
                $user->removeRole($role->input('roles'));
            }
            else {
                $user->assignRole($role->input('roles'));
            }
        }
        return redirect()->route('users.index');
    }
}
