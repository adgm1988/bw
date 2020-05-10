<?php

namespace App\Http\Controllers;

use App\Adjust;
use Illuminate\Http\Request;

class AdjustController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adjusts = Adjust::all();

        return view('pages.adjusts.list', compact('adjusts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Adjust  $adjust
     * @return \Illuminate\Http\Response
     */
    public function show(Adjust $adjust)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Adjust  $adjust
     * @return \Illuminate\Http\Response
     */
    public function edit(Adjust $adjust)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Adjust  $adjust
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Adjust $adjust)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Adjust  $adjust
     * @return \Illuminate\Http\Response
     */
    public function destroy(Adjust $adjust)
    {
        //
    }
}
