<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SaleDetail;
use DB;

class ReportController extends Controller
{
    //

    public function index()
    {

    	$months = DB::table('sale_details')
    			->join('inventories','inventories.id_inventory','sale_details.id_inventory')
    			->join('products','products.id_product','inventories.id_product')
    			->join('sales','sales.id_sale','sale_details.id_sale')
    			->select(DB::raw('DATE_FORMAT(sales.date, "%Y-%m") as month'))
    			->distinct()
    			->orderBy('month','ASC')
    			->get();

    	$products = DB::table('sale_details')
    			->join('inventories','inventories.id_inventory','sale_details.id_inventory')
    			->join('products','products.id_product','inventories.id_product')
    			->join('sales','sales.id_sale','sale_details.id_sale')
    			->select(DB::raw('products.product as product'))
    			->distinct()
    			->get();

        // REPORTES DE VENTA POR MXN

    	$datas = DB::table('sale_details')
    			->join('inventories','inventories.id_inventory','sale_details.id_inventory')
    			->join('products','products.id_product','inventories.id_product')
    			->join('sales','sales.id_sale','sale_details.id_sale')
    			->select(DB::raw('DATE_FORMAT(sales.date, "%Y-%m") as month'),'products.product', DB::raw('SUM(sale_details.sale_price) as total_sales'))
    			->groupBy('month','products.product')
    			->orderBy('products.product','ASC')
    			->orderBy('month','ASC')
    			->get();


    	$total_mensual = DB::table('sale_details')
    			->join('sales','sales.id_sale','sale_details.id_sale')
    			->select(DB::raw('DATE_FORMAT(sales.date, "%Y-%m") as month'), DB::raw('SUM(sale_details.sale_price) as total_sales'))
    			->groupBy('month')
    			->orderBy('month')
    			->get();


        //REPORTES DE TOTALES POR KILOGRAO

        $datas_kg = DB::table('sale_details')
                ->join('inventories','inventories.id_inventory','sale_details.id_inventory')
                ->join('products','products.id_product','inventories.id_product')
                ->join('sales','sales.id_sale','sale_details.id_sale')
                ->select(DB::raw('DATE_FORMAT(sales.date, "%Y-%m") as month'),'products.product', DB::raw('SUM(inventories.weight) as total_sales'))
                ->groupBy('month','products.product')
                ->orderBy('products.product','ASC')
                ->orderBy('month','ASC')
                ->get();
        

        $total_mensual_kg = DB::table('sale_details')
                ->join('sales','sales.id_sale','sale_details.id_sale')
                ->join('inventories','sale_details.id_inventory','inventories.id_inventory')
                ->select(DB::raw('DATE_FORMAT(sales.date, "%Y-%m") as month'), DB::raw('SUM(inventories.weight) as total_sales'))
                ->groupBy('month')
                ->orderBy('month')
                ->get();


    	if (isset($_GET['d'])) {
	    	if($_GET['d']=="p"){
	    		dd($products);
	    	}elseif ($_GET['d']=="m") {
	    		dd($months);
	    	}elseif($_GET['d']=="d"){
	    		dd($datas);
	    	}
	    }

    	return view('pages.reports.index',compact('datas','months','products','total_mensual','datas_kg','total_mensual_kg'));
    }
}


