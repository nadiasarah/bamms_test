<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
  public function customer()
  {
    return $this->hasOne('App\User',
                    'id', 'customer_id');
  }

  public function account()
  {
    return $this->hasMany('App\Account',
                    'customer_id', 'customer_id');
  }
}
