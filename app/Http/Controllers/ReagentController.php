<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReagentController extends Controller
{
    //
    public function index() {
      $reagents = \App\Reagent::all();

      return view('reagents')->with('reagents', $reagents);
    }

    public function reagents($producer_id) {
      $reagents = \App\Reagent::where('producer_id', $producer_id)
      ->where('is_handed', '0')
      ->get();

      return response()->json($reagents);
    }

    public function reagent($id) {
      $reagent = \App\Reagent::findOrFail($id);

      return response()->json($reagent);
    }

    public function store(Request $request) {
      $request->validate([
        'producer_id' => 'bail|required|integer',
        'receive_date' => 'required|date',
        'code' => 'required|unique:reagents',
        'name' => 'required',
        'expire' => 'required|date',
      ]);
      $reagent = $request->all();
      \App\Reagent::create($reagent);



      \Session::flash('producer_id', $request->producer_id);

      \Session::flash('receive_date', implode(" ", explode("-", $request->receive_date)));
      \Session::flash('success', 'reagent ' . $request->code . ' adaugat cu success');
      return redirect()->back();
    }

    public function edit($id) {
      $reagent = \App\Reagent::findOrFail($id);

      return response()->json($reagent);
    }

    public function delete($id) {
      $reagent = \App\Reagent::findOrFail($id);
      $reagent->delete();
      \Session::flash('delete', 'reagent ' . $reagent->code . ' a fost sters');
      return redirect()->back();
    }

    public function update($id, Request $request) {
      $reagent = \App\Reagent::findOrFail($id);
      $reagent->update($request->all());
      \Session::flash('update', 'reagent ' . $reagent->code . ' a fost modificat');
      return redirect()->back();
    }
}
