<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SaleDetail;
use App\AdjustDetail;

class Inventory extends Model
{

    protected $primaryKey = 'id_inventory';

    public function product()
    {
        return $this->belongsTo('App\Product','id_product','id_product');
    }

    public function sale_detail()
    {
        $id_sale_details = SaleDetail::where('id_inventory',$this->id_inventory);
        return($id_sale_details);
    }

    public function sale_details()
    {
        return $this->hasOne('App\SaleDetail','id_inventory','id_inventory');
    }

    public function adjust_details()
    {
        return $this->belongsTo('App\AdjustDetail','id_inventory','id_inventory');
    }
}
