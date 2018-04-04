<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reagent extends Model
{
    protected $guarded = [];

    public function producer() {
      return \App\Producer::findOrFail($this->producer_id)->name;
    }
}
