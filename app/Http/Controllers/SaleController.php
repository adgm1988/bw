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
        $inventories = Inventory::where('id_product',$id_product)
            ->whereRaw('id_inventory NOT IN (SELECT id_inventory FROM sale_details)')
            ->orderBy('id_inventory','asc')->get();

        return $inventories;
    }

    public function ajaxSaleDetailStore(Request $request)
    {

        $id_inventory = $request->id_inventory;
        $id_sale = $request->id_sale;
        $sale_price = $request->sale_price;


        $sale_detail = new SaleDetail;
        $sale_detail->id_inventory=$id_inventory;
        $sale_detail->id_sale=$id_sale;
        $sale_detail->sale_price= $sale_price;
       

        if( $sale_detail->save()){
                return response()->json(["response" =>true,"sale_detail"=>$sale_detail]);
              }else{
                return response()->json(["response" =>false,"sale_detail"=>$sale_detail]);
            }
    }

    public function deleteSaleDetail($saledetail)
    {

        $sale_detail = SaleDetail::find($saledetail);
        $sale_detail->delete();
        return back(); 
        
    }
}
