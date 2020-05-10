<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Product','id_product','id_product');
    }
}
