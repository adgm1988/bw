<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded=[];
    public $primaryKey = "id_product"; 
    
    public function product_category(){
    	return $this->hasOne('App\ProductCategory','id_product_category','id_product_category');
    }
}
