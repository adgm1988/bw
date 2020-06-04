<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntryDetail extends Model
{

	protected $primaryKey = 'id_entry_detail';

    public function inventory(){
    	return $this->belongsTo('App\Inventory','id_inventory','id_inventory');
    }
}
