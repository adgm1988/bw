<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $guarded=[];
    protected $primaryKey = 'id_entry';

    public function entry_details() 
    {
    	return $this->hasMany('App\EntryDetail','id_entry','id_entry');
    }

    public function inventory(){
        return $this->hasOneThrough('App\Inventory','App\EntryDetail','id_entry','id_entry_detail','id_entry','id_inventory');
    }

    public function payments()
    {
    	return $this->hasMany('App\EntryPayment','id_entry','id_entry');
    }

    public function getCost()
    {
        // return $this->
    }


   

}
