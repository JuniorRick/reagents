<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $guarded = [];

    public function person($id) {
      return \App\Person::findOrFail($id)->fullname;
    }

}
