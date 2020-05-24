<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = [];
    public $primaryKey = 'id_client';
    public function origin(){
    	return $this->belongsTo('App\Origin','id_origin','id_origin');
    }

    public function sales(){
    	return $this->hasMany('App\Sale','id_client');
    }

    public function payments()
    {
        return $this->hasManyThrough('App\Payment', 'App\Sale','id_client','id_sale','id_client','id_sale');
    }

}
