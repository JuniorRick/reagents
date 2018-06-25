<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersonController extends Controller
{

  public function __construct() {
    $this->middleware('\App\Http\Middleware\AdminMiddleware');
  }

  public function index() {
    $people = \App\Person::all();

    return view('people')->with('people', $people);
  }

  public function store(Request $request) {

    $request->validate([
      'fullname' => 'required|unique:people',
    ]);

    $person = $request->all();
    \App\Person::create($person);

    \Session::flash('success', $request->fullname . ' adaugat cu success');

    return redirect()->back();
  }

  public function edit($id) {
    $person = \App\Person::findOrFail($id);
    return response()->json($person);
  }

  public function delete($id) {
    $person = \App\Person::findOrFail($id);
    $person->delete();
    \Session::flash('delete', $person->fullname . ' a fost sters');
    return redirect()->back();
  }

  public function update($id, Request $request) {
    $person = \App\Person::findOrFail($id);
    $person->update($request->all());
    \Session::flash('update', $person->fullname . ' a fost modificat');
    return redirect()->back();
  }
}
