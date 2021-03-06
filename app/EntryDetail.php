<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntryDetail extends Model
{

	protected $primaryKey = 'id_entry_detail';

    public function inventory(){
    	return $this->hasOne('App\Inventory','id_inventory','id_inventory');
    }

    public function entry(){
    	return $this->belongsTo('App\Entry','id_entry','id_entry');
    }
}
