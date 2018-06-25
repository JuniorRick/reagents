<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{

  public function addRole(Request $request) {

    

    \Session::flash('success', 'rol ' . $request->name . ' adaugat cu success');
    return redirect()->back();
  }



}
