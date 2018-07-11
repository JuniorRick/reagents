<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function reports($id) {
      $order = \App\Order::findOrFail($id);
      $reports = \App\Report::where('order_id', $id)->get();

      return view('reports')->with(['order' => $order, 'reports' => $reports]);
    }

    public function store(Request $request) {

      $request->validate([
        'taken_quantity' => 'required|numeric',
        'person_id' => 'required|integer',
        'start_date' => 'required|date',
      ]);

      $report = $request->all();

      $order = \App\Order::findOrFail($request->order_id);

      if($order->order_quantity - $request->taken_quantity < 0){
        \Session::flash('error', 'eroare: cantitate indisponibila');
      } else {
        $order->order_quantity -= $request->taken_quantity;

        if($order->order_quantity > 0) {
          $order->state = 1;
        } else {
          $order->state = 2;
        }

        \App\Report::create($report);
        $order->save();
      }

      return redirect()->back();
    }

    public function edit($id) {
      $report = \App\Report::findOrFail($id);

      return response()->json($report);
    }

    public function delete($id) {
      $report = \App\Report::findOrFail($id);
      $report->delete();
      $order = \App\Order::find($report->order_id);
      $order->order_quantity += $report->taken_quantity;
      $qty = $order->reagentQty($order->reagent_id);
      if($order->order_quantity > 0) {
          $order->state = $order->order_quantity == $qty ? 0 : 1;
      }
      $order->save();

      \Session::flash('delete', 'detaliile au fost sterse');
      return redirect()->back();
    }

    public function update($id, Request $request) {
      $report = \App\Report::findOrFail($id);

      if( $report->taken_quantity != $request->taken_quantity) {
        $order = \App\Order::find($report->order_id);
        $order->order_quantity -= $request->taken_quantity - $report->taken_quantity;
        $order->save();
      }

      $report->update($request->all());
      \Session::flash('update', 'detaliie au fost modificate');
      return redirect()->back();
    }
}
