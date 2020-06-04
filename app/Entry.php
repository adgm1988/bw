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

    public function payments()
    {
    	return $this->hasMany('App\EntryPayments','id_entry','id_entry');
    }

   

}
