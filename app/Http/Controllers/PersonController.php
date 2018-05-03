<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersonController extends Controller
{
  public function index() {
    $people = \App\Person::all();

    return view('people')->with('people', $people);
  }

  public function store(Request $request) {

    $person = $request->all();
    \App\Person::create($person);

    return redirect()->back();
  }

  public function edit($id) {
    $person = \App\Person::findOrFail($id);

    return response()->json($person);
  }

  public function delete($id) {
    $person = \App\Person::findOrFail($id);
    $person->delete();

    return redirect()->back();
  }

  public function update($id, Request $request) {
    $person = \App\Person::findOrFail($id);
    $person->update($request->all());

    return redirect()->back();
  }
}
