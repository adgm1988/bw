<?php

namespace App\Http\Controllers;

use App\EntryDetail;
use Illuminate\Http\Request;

class EntryDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entry_details = EntryDetail::all();

        return view('pages.entry_details.list', compact('entry_details'));
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
     * @param  \App\EntryDetail  $entryDetail
     * @return \Illuminate\Http\Response
     */
    public function show(EntryDetail $entryDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EntryDetail  $entryDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(EntryDetail $entryDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EntryDetail  $entryDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EntryDetail $entryDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EntryDetail  $entryDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(EntryDetail $entryDetail)
    {
        //
    }
}
