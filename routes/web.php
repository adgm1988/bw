<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect("clients");
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => ['auth']], function() {
    // your routes


//MODULOS

Route::get('clients','ClientController@index');
Route::get('clients/create','ClientController@create');
Route::post('clients/store','ClientController@store');

Route::get('sales','SaleController@index');
Route::get('sales/create','SaleController@create');
Route::post('sales/store','SaleController@store');
Route::get('sales/{sale}','SaleController@show');
Route::post('sales/getDetailOptions','SaleController@getDetailOptions');
Route::post('sales/saveSaleDetail','SaleController@ajaxSaleDetailStore');
Route::get('sales/deleteSaleDetail/{sale_detail}','SaleController@deleteSaleDetail');
Route::get('sales/deletePayment/{payment}','SaleController@deletePayment');
Route::post('sales/savePayment','SaleController@ajaxPaymentStore');


Route::get('inventories','InventoryController@index');

Route::get('entries','EntryController@index');
Route::get('entries/create','EntryController@create');
Route::post('entries/store','EntryController@store');
Route::get('entries/{entry}','EntryController@show');
Route::post('entries/saveEntryDetail','EntryController@ajaxEntryDetailStore');
Route::get('entries/deleteEntryDetail/{entry_detail}','EntryController@deleteEntryDetail');


Route::get('adjusts','AdjustController@index');
Route::get('adjusts/create/{id_inventory}','AdjustController@create');


//HISTORIALES

Route::get('entry_details','EntryDetailController@index');

Route::get('sale_details','SaleDetailController@index');

Route::get('adjust_details','AdjustDetailController@index');
Route::post('adjust_details/store/{id_inventory}','AdjustDetailController@store');
Route::get('adjust_details/delete/{adjustDetail}','AdjustDetailController@destroy');

Route::get('payments','PaymentController@index');


//CATÁLOGOS
Route::get('origins','OriginController@index');
Route::post('origins/store','OriginController@store');

Route::get('products','ProductController@index');
Route::post('products/store','ProductController@store');

Route::get('product_categories','ProductCategoryController@index');
Route::post('product_categories/store','ProductCategoryController@store');

Route::get('payment_types','PaymentTypeController@index');
Route::post('payment_types/store','PaymentTypeController@store');

//REPORTS
Route::get('reports','ReportController@index');


});





