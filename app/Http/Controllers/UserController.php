<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{

  public function store(Request $request) {
    $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:6|confirmed',
    ]);

    $user = $request->all();
    $user['password'] = Hash::make($request->password);
    \App\User::create($user);

    $role = Role::findOrFail($request->role_id);
    $user->roles()->detach($user->roles);
    $user->assignRole($role);

    \Session::flash('success', 'utilizator ' . $request->name . ' adaugat cu success');
    return redirect()->back();
  }

  public function edit($id) {
    $user = \App\User::findOrFail($id);

    return response()->json($user);
  }

  public function update($id, Request $request) {
    $user = \App\User::findOrFail($id);
    $user->name = $request->name;
    $user->email = $request->email;
    $role = Role::findOrFail($request->role_id);
    if(strlen($request->password) >= 6) {
      $user->password = Hash::make($request->password);
    }

    $user->save();
    $user->roles()->detach($user->roles);
    $user->assignRole($role);
    \Session::flash('update', 'utilizator ' . $user->name . ' a fost modificat');
    return redirect()->back();
  }

  public function delete($id) {
    $user = \App\User::findOrFail($id);
    if($user == \Auth::user()) {
      \Session::flash('error', 'utilizatorul ' . $user->name . ' este acum logat');
    } else {
      $user->delete();
      \Session::flash('delete', 'utilizatorul ' . $user->name . ' a fost sters');
    }

    return redirect()->back();
  }

}
