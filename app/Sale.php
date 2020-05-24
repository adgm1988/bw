<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{

	protected $guarded=[];
    protected $primaryKey = 'id_sale';

    public function client()
    {
        return $this->belongsTo('App\Client','id_client','id_client');
    }

    public function sale_details()
    {
    	return $this->hasMany('App\SaleDetail', 'id_sale', 'id_sale');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment', 'id_sale');
    }



}
