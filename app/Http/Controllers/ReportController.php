<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function reports($id) {
      $order = \App\Order::findOrFail($id);

      return view('reports')->with('order', $order);
    }
}
