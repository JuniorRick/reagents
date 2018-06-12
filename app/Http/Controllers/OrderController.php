<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct() {
    \Session::flash('flag', 'flag');
    }

    public function index() {
      \Session::forget('success');
      $orders = \App\Order::all();
      return view('orders')->with('orders', $orders);
    }

    public function orders() {

      $orders = \App\Order::all();

      return view('ordersAll')->with('orders', $orders);
    }

    public function store(Request $request) {

      $order = $request->all();
      \App\Order::insert($order);

      $reagent = \App\Reagent::findOrFail($request->reagent_id);
      $reagent->update(['is_handed' => 1]);

      \Session::flash('success', ' eliberari efectuate cu success');
      return redirect()->back();
    }

    public function bulkstore(Request $request) {
      $orders = $request->all();
      $file = fopen('file.txt','w');
      foreach($orders as $order) {
        $order = (object) $order;
        fwrite($file, gettype($order));
        $obj = new \App\Order;
        $obj->reagent_id = $order->reagent_id;
        $obj->person_id = $order->person_id;
        $obj->created_at = $order->created_at;
        $obj->handed_date = $order->handed_date;
        $obj->save();
        $reagent = \App\Reagent::findOrFail($obj->reagent_id);
        $reagent->update(['is_handed' => 1]);
      }
       $request->session()->put('bulk_success', 'eliberari efectuate cu succes');
       $request->session()->forget('flag');

    }

    public function edit($id) {
      $order = \App\Order::findOrFail($id);

      return response()->json($order);
    }

    public function delete($id) {
      $order = \App\Order::findOrFail($id);
      $order->delete();

      $reagent = \App\Reagent::findOrFail($order->reagent_id);
      $reagent->update(['is_handed' => 0]);

      \Session::flash('delete', $reagent->name . ' a fost sters din lista de eliberari');
      return redirect()->back();
    }

    public function update($id, Request $request) {
      $order = \App\Order::findOrFail($id);
      $order->update($request->all());
      \Session::flash('update', 'ordinul cu id ' . $order->id . ' a fost modificat');

      return redirect()->back();
    }
}
