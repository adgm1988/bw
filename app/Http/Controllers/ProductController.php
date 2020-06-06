<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $product_categories = ProductCategory::all();

        return view('pages.products.list', compact('products','product_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Product::create($request->all());
        return redirect('products');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validated= $request->validate([
            'id_product_category'=>'required',
            'product'=>'required',
            'price'=>'required',
            'cost'=>'required',
            'color'=>'required',

        ]);

        $product = new Product;
        $product->id_product_category = $request->get('id_product_category');
        $product->product = $request->get('product');
        $product->price = $request->get('price');
        $product->cost = $request->get('monto');
        $product->color = $request->get('color');


        if($request->file('image')){
            $path = $request->file('image')->store('public/products');
            
            $path = str_replace("public/","",$path);

            $product->image = $path;
        }

        $product->save();


        return redirect('products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   

        $product = Product::find($request->e_id_product);

        $product->id_product_category = $request->e_id_product_category;
        $product->product = $request->e_product;
        $product->cost = $request->e_cost;
        $product->price = $request->e_price;
        $product->color = $request->e_color;

        if($request->file('image')){

            $path = $request->file('e_image')->store('public/products');
            
            $path = str_replace("public/","",$path);

            $product->image = $path;
        }

        $product->save();

        return redirect('products');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function getproduct(Product $product)
    {
        return $product;
    }
}
