<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProducerController extends Controller
{
    public function index() {
      $producers = \App\Producer::all();

      return view('producers')->with('producers', $producers);
    }

    public function store(Request $request) {

      $producer = $request->all();
      \App\Producer::create($producer);

      return redirect()->back();
    }

    public function edit($id) {
      $producer = \App\Producer::findOrFail($id);

      return response()->json($producer);
    }

    public function delete($id) {
      $producer = \App\Producer::findOrFail($id);
      $producer->delete();

      return redirect()->back();
    }

    public function update($id, Request $request) {
      $producer = \App\Producer::findOrFail($id);
      $producer->update($request->all());

      return redirect()->back();
    }
}
