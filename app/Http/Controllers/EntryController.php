<?php

namespace App\Http\Controllers;

use App\Entry;
use App\ProductCategory;
use App\Product;
use App\EntryDetail;
use App\Inventory;
use App\PaymentType;
use App\EntryPayment;
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
            $nuevo_id = 1;
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
        $total_weight = DB::table('entry_details')
                    ->where('id_entry',$entry->id_entry)
                    ->join('inventories','inventories.id_inventory','entry_details.id_inventory')
                    ->sum('inventories.weight');

        $total_cost = DB::table('entry_details')
                    ->where('id_entry',$entry->id_entry)
                    ->join('inventories','inventories.id_inventory','entry_details.id_inventory')
                    ->sum('inventories.cost');



        $balance = $total_cost-$entry->payments->sum('amount');

        $product_categories = ProductCategory::all();
        $payment_types = PaymentType::all();
        $products = Product::all();

        return view('pages.entries.record', compact('entry','product_categories','products','entry_details','products_detail','products','total_weight','total_cost','payment_types','balance'));
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

        $product_cost = Product::find($id_product)->cost;
        $inventory = new Inventory;
        $inventory->id_product = $id_product;
        $inventory->weight = $weight;
        $inventory->cost = $weight*$product_cost/1000;

        if($inventory->save()){
            
            $id_inventory = $inventory->id_inventory;

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


    public function deleteentryDetail($entrydetail)
    {

        $entry_detail = EntryDetail::find($entrydetail);
        $inventory = Inventory::find($entry_detail->id_inventory);
        $inventory->delete();
        $entry_detail->delete();
        return back(); 
        
    }

     public function ajaxPaymentStore(Request $request)
    {

        $payment = new EntryPayment;
        $payment->id_entry=$request->id_entry;
        $payment->amount = $request->amount;
        $payment->date = $request->date;
        $payment->id_payment_type=$request->id_payment_type;
       

        if( $payment->save()){
                return response()->json(["response" =>true,"payment"=>$payment]);
              }else{
                return response()->json(["response" =>false,"payment"=>$payment]);
            }
    }

    public function deletePayment($payment)
    {

        $payment = EntryPayment::find($payment);
        $payment->delete();
        return back();
        
    }

        
}
