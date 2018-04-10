<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function reagentCode($id) {
      return \App\Reagent::findOrFail($id)->code;
    }

    public function reagentTitle($id) {
      return \App\Reagent::findOrFail($id)->name;
    }

    public function person($id) {
      return \App\Person::findOrFail($id)->fullname;
    }
}
