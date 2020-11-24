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
    Route::get('distributor/data', 'DistributorController@getRecord')->name('distributor_data');
    Route::post('distributor/store', 'DistributorController@store')->name('distributor_store');
    Route::get('distributor/edit/{id}', 'DistributorController@getRecord')->name('distributor_edit');
    Route::post('distributor/update', 'DistributorController@update')->name('distributor_update');
    Route::get('distributor/delete/{id}', 'DistributorController@destroy')->name('distributor_delete');
    Route::get('distributor/search', 'DistributorController@getRecord')->name('distributor_search');
    Route::get('distributor/outlet/{id}', 'DistributorController@getTotalOutlet')->name('distributor_outlet');
    Route::get('distributor/sale/{id}', 'DistributorController@getTotalSale')->name('distributor_sale');


    //Outlet
    Route::get('outlate', 'OutletController@index')->name('outlet');
    Route::post('outlate/store', 'OutletController@store')->name('outlet_store');
    Route::get('outlate/edit/{id}', 'OutletController@index')->name('outlet_edit');
    Route::post('outlate/update', 'OutletController@update')->name('outlet_update');
    Route::get('outlate/delete/{id}', 'OutletController@destroy')->name('outlet_delete');
    Route::get('outlate/service/{id}', 'OutletController@getTotalSale')->name('outlet_service');

    //Product as Service
    Route::get('service', 'ServiceController@index')->name('service');
    Route::post('service/store', 'ServiceController@store')->name('service_store');
    Route::get('service/edit/{id}', 'ServiceController@index')->name('service_edit');
    Route::post('service/update', 'ServiceController@update')->name('service_update');
    Route::get('service/delete/{id}', 'ServiceController@destroy')->name('service_delete');

    //Service as Sale
    Route::get('sale', 'SaleController@index')->name('sale');
    Route::get('sale/ajax/data', 'SaleController@getRecord')->name('sale_ajax_get_datatable');
    Route::get('sale/create', 'SaleController@create')->name('sale_new');
    Route::post('sale/store', 'SaleController@store')->name('sale_store');
    Route::get('sale/edit/{id}', 'SaleController@edit')->name('sale_edit');
    Route::post('sale/update', 'SaleController@update')->name('sale_update');
    Route::get('sale/delete/{id}', 'SaleController@destroy')->name('sale_delete');
    Route::get('sale/search/', 'SaleController@ajaxSearch')->name('sale_search');
    Route::get('sale/export/excel', 'SaleController@exportExcel')->name('sale_export_excel');


    Route::get('sale/outletrecord', function(){
        $getOutlet = App\Outlet::orderBy('id', 'DESC')->get();
        return view('admin.sale.outlet-record', compact('getOutlet'));
    })->name('sale_outlet_record');

    Route::get('sale/outlet/new', function(){
        return view('admin.sale.modal-new-outlet-form');
    })->name('sale_outlet_modal_form');

    Route::get('sale/outlet/edit/{id}', function($id){
        $editOutletID = $id;
        $editOutlet = App\Outlet::find($id);
        return view('admin.sale.modal-new-outlet-form', compact('editOutlet', 'editOutletID'));
    })->name('sale_outlet_modal_form_edit');

    Route::get('sale/filter/outlet/{id}', 'SaleController@filterOutlet')->name('sale_filterOutlet');
    Route::get('sale/filter/distributor/{id}', 'SaleController@filterDistributor')->name('sale_filterDistributor');

    Route::get('sale/filter/date/{id}', 'SaleController@filterDate')->name('sale_filterDate');

    //Alert Previous Service When Selecting Visi id on new Service
    Route::get('sale/showalert-prvious/{id}', 'SaleController@alertPreviousVisi')->name('sale_showalert_previous_visi');
    Route::get('sale/showalert-prvious-count/{id}', 'SaleController@countAlertPreviousVisi')->name('count_sale_showalert_previous_visi');

    //pdf
    Route::get('/downloadPDF','SaleController@downloadPDF')->name('sale_pdf');


    //User
    Route::get('user', 'HomeController@userIndex')->name('user_index');
    Route::post('user/store', 'HomeController@userStore')->name('user_store');
    Route::get('user/edit/{id}', 'HomeController@userIndex')->name('user_edit');
    Route::post('user/update', 'HomeController@userUpdate')->name('user_update');
    Route::get('user/delete/{datefilter}', 'HomeController@userDestroy')->name('user_delete');

});

//Api
Route::get('/api/outlet', 'ApiController@outlet')->name('api_outlet');
Route::get('/api/service', 'ApiController@service')->name('api_service');
Route::get('/api/service/{id}', 'ApiController@service')->name('api_service_id');
Route::get('/api/distributor', 'ApiController@distributor')->name('api_distributor');


Route::get('/test', function(){
    return view('test');
});


Auth::routes([
  'register' => false, // Registration Routes...
  'reset' => false, // Password Reset Routes...
  'verify' => false, // Email Verification Routes...
]);

Route::get('/home', function () {
    //return view('welcome');
    return redirect()->route('admin_index');
});

//Route::get('/home', 'HomeController@index')->name('home');