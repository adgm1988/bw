<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = [];
    public function origin(){
    	return $this->belongsTo('App\Origin','id_origin','id_origin');
    }
}
