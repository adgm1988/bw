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

    public function getCostAttribute()
    {

        $inventories =  $this->entry_details->pluck('id_inventory');
        $cost = Inventory::whereIn('id_inventory',$inventories)->sum('cost');
        return $cost;
    }

    public function getBalanceAttribute()
    {

        $inventories =  $this->entry_details->pluck('id_inventory');
        $cost = Inventory::whereIn('id_inventory',$inventories)->sum('cost');

        return $cost-$this->payments->sum('amount');
    }

    public function getColorAttribute()
    {

        $inventories =  $this->entry_details->pluck('id_inventory');
        $cost = Inventory::whereIn('id_inventory',$inventories)->sum('cost');

        $balance =  $cost-$this->payments->sum('amount');

        if($balance > 0){
            return "bg-danger";
        }else{
            return "bg-success";
        }
    }



   

}
