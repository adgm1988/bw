<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntryPayment extends Model
{
    //
    protected $primaryKey = 'id_entry_payment';

  	 public function payment_type(){
    	return $this->hasOne('App\PaymentType','id_payment_type','id_payment_type');
    }

    public function entry(){
    	return $this->belongsTo('App\Entry','id_entry','id_entry');
    }
}
