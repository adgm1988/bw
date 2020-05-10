<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    public function inventory()
    {
        return $this->belongsTo('App\Inventory','id_inventory','id_inventory');
    }
}
