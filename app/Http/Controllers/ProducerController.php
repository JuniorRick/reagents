<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProducerController extends Controller
{

  public function __construct() {
    $this->middleware('\App\Http\Middleware\AdminMiddleware');
  }

    public function index() {
      $producers = \App\Producer::all();

      return view('producers')->with('producers', $producers);
    }

    public function store(Request $request) {

      $request->validate([
        'name' => 'required|unique:producers',
      ]);
      $producer = $request->all();
      \App\Producer::create($producer);
      \Session::flash('success', $request->name . ' adaugat cu success');
      return redirect()->back();
    }

    public function edit($id) {
      $producer = \App\Producer::findOrFail($id);

      return response()->json($producer);
    }

    public function delete($id) {
      $producer = \App\Producer::findOrFail($id);
      $producer->delete();
      \Session::flash('delete', $producer->name . ' a fost sters');
      return redirect()->back();
    }

    public function update($id, Request $request) {
      $producer = \App\Producer::findOrFail($id);
      $producer->update($request->all());
      \Session::flash('update', $producer->name . ' a fost modificat');
      return redirect()->back();
    }
}
