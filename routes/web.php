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
    //return view('welcome');
    return redirect()->route('admin_index');
});


Route::group(['prefix'=> 'admin/', 'namespace'=> 'Admin', 'as' => 'admin_','middleware' => ['auth']], function(){
    
    Route::get('/', 'HomeController@index')->name('index');

    //Distributor
    Route::get('distributor', 'DistributorController@index')->name('distributor');
    Route::post('distributor/store', 'DistributorController@store')->name('distributor_store');
    Route::get('distributor/edit/{id}', 'DistributorController@index')->name('distributor_edit');
    Route::post('distributor/update', 'DistributorController@update')->name('distributor_update');
    Route::get('distributor/delete/{id}', 'DistributorController@destroy')->name('distributor_delete');
    Route::get('distributor/outlet/{id}', 'DistributorController@getTotalOutlet')->name('distributor_outlet');


    //Outlet
    Route::get('outlate', 'OutletController@index')->name('outlet');
    Route::post('outlate/store', 'OutletController@store')->name('outlet_store');
    Route::get('outlate/edit/{id}', 'OutletController@index')->name('outlet_edit');
    Route::post('outlate/update', 'OutletController@update')->name('outlet_update');
    Route::get('outlate/delete/{id}', 'OutletController@destroy')->name('outlet_delete');
    Route::get('outlate/service/{id}', 'OutletController@getTotalSale')->name('outlet_service');

    //Product
    Route::get('service', 'ServiceController@index')->name('service');
    Route::post('service/store', 'ServiceController@store')->name('service_store');
    Route::get('service/edit/{id}', 'ServiceController@index')->name('service_edit');
    Route::post('service/update', 'ServiceController@update')->name('service_update');
    Route::get('service/delete/{id}', 'ServiceController@destroy')->name('service_delete');

    //Service
    Route::get('sale', 'SaleController@index')->name('sale');
    Route::get('sale/create', 'SaleController@create')->name('sale_new');
    Route::post('sale/store', 'SaleController@store')->name('sale_store');
    Route::get('sale/edit/{id}', 'SaleController@edit')->name('sale_edit');
    Route::post('sale/update', 'SaleController@update')->name('sale_update');
    Route::get('sale/delete/{id}', 'SaleController@destroy')->name('sale_delete');
    Route::get('sale/search/', 'SaleController@ajaxSearch')->name('sale_search');
});

//Api
Route::get('/api/outlet', 'ApiController@outlet')->name('api_outlet');
Route::get('/api/service', 'ApiController@service')->name('api_service');


Route::get('/test', function(){
    //return view('test');
});


Auth::routes();

Route::get('/home', function () {
    //return view('welcome');
    return redirect()->route('admin_index');
});

//Route::get('/home', 'HomeController@index')->name('home');
