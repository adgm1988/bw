<?php

namespace App\Http\Controllers;

use App\Sale;
use App\Client;
use App\SaleDetail;
use App\ProductCategory;
use App\Product;
use App\Inventory;
use Illuminate\Http\Request;
use DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::all();

        return view('pages.sales.list', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $clients=Client::all();
        return view('pages.sales.form', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $sale= Sale::create($request->all());
        return redirect('sales/'.$sale->id_sale);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        $sale = Sale::find($sale->id_sale);
        $sale_details = SaleDetail::where('id_sale',$sale->id_sale)->orderBy('id_sale_details','desc')->get();

        $id_products = DB::table('sale_details')
            ->where('id_sale',$sale->id_sale)
            ->join('inventories', 'sale_details.id_inventory', '=', 'inventories.id_inventory')
            ->join('products','inventories.id_product','products.id_product')
            ->select('inventories.id_product')
            ->distinct()
            ->pluck('inventory.id_product')->toArray();
        
        $products_detail = DB::table('products')
                    ->whereIn('id_product', $id_products)->get(); 

        $product_categories = ProductCategory::all();
        $products = Product::all();

        return view('pages.sales.record', compact('sale','product_categories','products','sale_details','products_detail','products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }

    public function getDetailOptions(Request $request)
    {
        $id_product = $request->id_product;
        $inventories = Inventory::where('id_product',$id_product)->orderBy('id_inventory','asc')->get();
        return $inventories;
    }
}
