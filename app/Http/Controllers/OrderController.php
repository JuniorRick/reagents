<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index() {
      $orders = \App\Order::all();

      return view('orders')->with('orders', $orders);
    }

    public function orders() {

      $orders = \App\Order::all();

      return view('ordersAll')->with('orders', $orders);
    }

    //TODO
    public function store(Request $request) {

      $orders = $request->all();
        \App\Order::insert($orders);

        foreach($orders as $order) {
          \App\Reagent::find($order->reagent_id)
          ->update('is_handed' => 1);
        }
      return redirect()->back();
    }

    public function edit($id) {
      $order = \App\Order::findOrFail($id);

      return response()->json($order);
    }

    public function delete($id) {
      $order = \App\Order::findOrFail($id);
      $order->delete();

      return redirect()->back();
    }

    public function update($id, Request $request) {
      $order = \App\Order::findOrFail($id);
      $order->update($request->all());

      return redirect()->back();
    }
}
