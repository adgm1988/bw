<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    
    protected $primaryKey = "id_payment";

    public function payment_type(){
    	return $this->hasOne('App\PaymentType','id_payment_type','id_payment_type');
    }

}
