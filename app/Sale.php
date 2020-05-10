<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public function client()
    {
        return $this->belongsTo('App\Client','id_client','id_client');
    }

}
