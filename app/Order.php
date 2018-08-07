<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function reagentCode($id) {
      return \App\Reagent::findOrFail($id)->code;
    }

    public function producer($id) {
      $producer_id = \App\Reagent::findOrFail($id)->producer_id;
      return \App\Producer::findOrFail($producer_id)->name;
    }

    public function reagentRef($id) {
      return \App\Reagent::findOrFail($id)->ref;
    }

    public function reagentLot($id) {
      return \App\Reagent::findOrFail($id)->lot;
    }

    public function reagentExpireDate($id) {
      return explode(" ", \App\Reagent::findOrFail($id)->expire)[0];
    }

    public function reagentTitle($id) {
      return \App\Reagent::findOrFail($id)->name;
    }
    public function reagentQty($id) {
      return \App\Reagent::findOrFail($id)->quantity;
    }

    public function person($id) {
      return \App\Person::findOrFail($id)->fullname;
    }
}
