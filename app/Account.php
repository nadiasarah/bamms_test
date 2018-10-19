<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
  public function customer()
  {
    return $this->hasOne('App\User',
                    'id', 'customer_id');
  }

  public function transaction()
  {
    return $this->hasMany('App\Transaction',
                    'customer_id', 'customer_id');
  }
}
