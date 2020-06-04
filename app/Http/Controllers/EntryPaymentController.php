<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EntryPayment;


class EntryPaymentController extends Controller
{
    //
    public function index(){
    	$payments = EntryPayment::all();

        return view('pages.entry_payment.list', compact('payments'));
    }
}
