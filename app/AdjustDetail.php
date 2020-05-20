<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdjustDetail extends Model
{
    
    protected $primaryKey ='id_adjust_detail';

    public function inventory(){
    	return $this->belongsTo('App\Inventory','id_inventory','id_inventory');
    }
}
