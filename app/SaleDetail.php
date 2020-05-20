<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{

	protected $primaryKey="id_sale_details";

    public function inventory()
    {
        return $this->belongsTo('App\Inventory','id_inventory','id_inventory');
    }

   public function weight()
   {
   		return $this->inventory->weight;
   }

}
