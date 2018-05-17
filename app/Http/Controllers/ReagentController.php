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

      $reagent = $request->all();
      \App\Reagent::create($reagent);

      return redirect()->back();
    }

    public function edit($id) {
      $reagent = \App\Reagent::findOrFail($id);

      return response()->json($reagent);
    }

    public function delete($id) {
      $reagent = \App\Reagent::findOrFail($id);
      $reagent->delete();

      return redirect()->back();
    }

    public function update($id, Request $request) {
      $reagent = \App\Reagent::findOrFail($id);
      $reagent->update($request->all());

      return redirect()->back();
    }
}
