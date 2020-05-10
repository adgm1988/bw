<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    public function payment_type(){
    	return $this->hasOne('App\PaymentType','id_payment_type','id_payment_type');
    }

}
