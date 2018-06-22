<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index() {
      $settings = \App\Setting::first();
      return view('/settings')->with('settings', $settings);
    }

    public function save(Request $request) {
      $settings = \App\Setting::first();
      $input = request()->all();

      $settings->fill($input)->save();

      return redirect()->back();
    }
}
