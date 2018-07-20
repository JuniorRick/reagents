<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
  protected function changeOrderStatus($order) {
    $reports = \App\Report::where('order_id', $order->id)->get();
    $counter = 0;

    foreach ($reports as $report) {
      // if(\Carbon\Carbon::createFromFormat('Y-m-d', $report->end_date) !== false
      if($report->end_date !== null && $order->order_quantity == 0) {
        $counter++;
      }
      $order->state = $counter == sizeof($reports) ? 1 : 0;
    }
  }


    public function reports($id) {
      $order = \App\Order::findOrFail($id);
      $reports = \App\Report::where('order_id', $id)->get();

      return view('reports')->with(['order' => $order, 'reports' => $reports]);
    }


    public function reportLab() {
      return \Excel::download( new \App\Exports\ReagentExport, 'report.xlsx');
    }

    public function store(Request $request) {

      $request->validate([
        'taken_quantity' => 'required|numeric',
        'person_id' => 'required|integer',
        'start_date' => 'required|date',
      ]);

      $report = $request->all();

      $order = \App\Order::findOrFail($request->order_id);

      if($order->order_quantity - $request->taken_quantity < 0) {
        \Session::flash('error', 'eroare: cantitate indisponibila');
      } else {
        $order->order_quantity -= $request->taken_quantity;

        \App\Report::create($report);
      }
      $this->changeOrderStatus($order);
      $order->save();

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
      if($order->order_quantity > $qty) {
        $order->order_quantity = $qty;
      }
      if($order->order_quantity > 0) {
          $order->state = 0;
      }

      $order->save();

      \Session::flash('delete', 'detaliile au fost sterse');
      return redirect()->back();
    }

    public function update($id, Request $request) {
      $report = \App\Report::findOrFail($id);

      $order = \App\Order::find($report->order_id);

      if( $report->taken_quantity != $request->taken_quantity) {
        $order->order_quantity -= $request->taken_quantity - $report->taken_quantity;
      }

      $report->update($request->all());
      $this->changeOrderStatus($order);

      $order->save();

      \Session::flash('update', 'detaliie au fost modificate');
      return redirect()->back();
    }



}
