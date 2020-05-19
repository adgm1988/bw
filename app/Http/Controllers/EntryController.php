<?php

namespace App\Http\Controllers;

use App\Entry;
use App\ProductCategory;
use App\Product;
use App\EntryDetail;
use App\Inventory;
use DB;

use Illuminate\Http\Request;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entries = Entry::all();

        return view('pages.entries.list', compact('entries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entry = DB::table('entries')->orderBy('id_entry', 'desc')->first();
        if($entry){
            $nuevo_id = $entry->id_entry + 1;
        }else{
            $nnuevo_id = 1;
        }

        return view('pages.entries.form',compact('nuevo_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $entry= Entry::create($request->all());
        return redirect('entries/'.$entry->id_entry);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function show(Entry $entry)
    {
        $entry = Entry::find($entry->id_entry);
        $entry_details = EntryDetail::where('id_entry',$entry->id_entry)->orderBy('id_inventory','desc')->get();

        $id_products = DB::table('entry_details')
            ->where('id_entry',$entry->id_entry)
            ->join('inventories', 'entry_details.id_inventory', '=', 'inventories.id_inventory')
            ->join('products','inventories.id_product','products.id_product')
            ->select('inventories.id_product')
            ->distinct()
            ->pluck('inventory.id_product')->toArray();
        
        $products_detail = DB::table('products')
                    ->whereIn('id_product', $id_products)->get(); 

        $product_categories = ProductCategory::all();
        $products = Product::all();

        return view('pages.entries.record', compact('entry','product_categories','products','entry_details','products_detail','products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function edit(Entry $entry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entry $entry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entry $entry)
    {
        //
    }

    public function ajaxEntryDetailStore(Request $request)
    {

        $id_product = $request->id_product;
        $id_entry = $request->id_entry;
        $weight = $request->weight;

        $inventory = new Inventory;
        $inventory->id_product = $id_product;
        $inventory->weight = $weight;
        if($inventory->save()){
            $id_inventory = $inventory->id;

            $entry_detail = new EntryDetail;
            $entry_detail->id_entry=$id_entry;
            $entry_detail->id_inventory=$id_inventory;

            if($entry_detail->save()){
                return response()->json(["response" =>true,"entry_detail"=>$entry_detail]);
              }
                return response()->json(["response" =>false,"entry_detail"=>$entry_detail]);
            }else{
                return response()->json(["response" =>false]);
            }
        }

        
}
