<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $guarded=[];
    protected $primaryKey = 'id_entry';

    public function entry_details() 
    {
    	return $this->hasMany('App\EntryDetail','id_entry_detail','id_entry_detail');
    }

   

}
