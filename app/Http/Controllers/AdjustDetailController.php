<?php

namespace App\Http\Controllers;

use App\AdjustDetail;
use Illuminate\Http\Request;

class AdjustDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adjust_details = AdjustDetail::all();

        return view('pages.adjust_details.list', compact('adjust_details'));
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
    public function store(Request $request, $id_inventory)
    {


        $adjust_detail = new AdjustDetail;
        $adjust_detail->id_adjust = 1;
        $adjust_detail->id_inventory = $id_inventory;
        $adjust_detail->reason = $request->reason;
        $adjust_detail->note = $request->note;

        $adjust_detail->save();

        return redirect('inventories');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AdjustDetail  $adjustDetail
     * @return \Illuminate\Http\Response
     */
    public function show(AdjustDetail $adjustDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AdjustDetail  $adjustDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(AdjustDetail $adjustDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AdjustDetail  $adjustDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdjustDetail $adjustDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AdjustDetail  $adjustDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdjustDetail $adjustDetail)
    {
        $adjustDetail->delete();
        return redirect ('adjust_details');
    }
}
