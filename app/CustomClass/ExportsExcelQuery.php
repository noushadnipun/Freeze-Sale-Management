<?php

namespace App\CustomClass;
use App\Sale;
use Illuminate\Database\Eloquent\Model;

class ExportsExcelQuery extends Model
{
    //
    public function getSaleSearchBoxInput($arg){
        return Sale::with('saleItems')
                    ->leftJoin('outlets', 'outlets.id', '=', 'sales.outlet_id')
                    ->leftJoin('distributors', 'distributors.id', '=', 'outlets.distributor_id')
                    ->select('outlets.name as outletName', 'outlets.mobile as outletMobile', 'outlets.address as outletAddress','outlets.visi_id', 'outlets.visi_size',
                            'sales.*', 
                            'distributors.name as dbName', 'distributors.id as dbID' 
                    )->where('outlets.name', 'LIKE', '%'.$arg.'%')
                    ->orWhere('outlets.visi_id', 'LIKE', '%'.$arg.'%')
                    ->orWhere('outlets.visi_size', 'LIKE', '%'.$arg.'%')
                    ->orWhere('distributors.name', 'LIKE', '%'.$arg.'%')
                    ->orWhere('call_no', 'LIKE', '%'.$arg.'%')
                    //->orwhere('outlets.visi_id',$request->search)
                    //->orwhere('outlets.visi_size',$request->search)
                    ->orderBy('id', 'DESC')->get();
    }

    //
    public function getSaleExceldateFilter($arg){
        $date = $arg;
         
        $explode = explode(' - ', $date);
        return Sale::with('saleItems')->leftJoin('outlets', 'outlets.id', '=', 'sales.outlet_id')
                                        ->leftJoin('distributors', 'distributors.id', '=', 'outlets.distributor_id')
                                        ->select('outlets.name as outletName', 'outlets.mobile as outletMobile', 'outlets.address as outletAddress','outlets.visi_id', 'outlets.visi_size',
                                                'sales.*', 
                                                'distributors.name as dbName', 'distributors.id as dbID' 
                                        )//->whereBetween('sales.created_at', array($explode[0], $explode[1]))
                                        ->whereBetween('sales.call_date', array($explode[0], $explode[1]))
                                        ->orderBy('id', 'DESC')->get();
    
    }

    //

    public function getSaleExcelOutletFilter($arg){
        return Sale::with('saleItems')
                        ->leftJoin('outlets', 'outlets.id', '=', 'sales.outlet_id')
                        ->leftJoin('distributors', 'distributors.id', '=', 'outlets.distributor_id')
                        ->select('outlets.name as outletName', 'outlets.mobile as outletMobile', 'outlets.address as outletAddress','outlets.visi_id', 'outlets.visi_size',
                                'sales.*', 
                                'distributors.name as dbName', 'distributors.id as dbID' 
                        )->where('outlet_id', $arg)
                        ->orderBy('id', 'DESC')->get();
    }

    //
    public function getSaleExcelDistributorFilter($arg){

       return Sale::with('saleItems')
                        ->leftJoin('outlets', 'outlets.id', '=', 'sales.outlet_id')
                        ->leftJoin('distributors', 'distributors.id', '=', 'outlets.distributor_id')
                        ->select('outlets.name as outletName', 'outlets.mobile as outletMobile', 'outlets.address as outletAddress','outlets.visi_id', 'outlets.visi_size',
                                'sales.*', 
                                'distributors.name as dbName', 'distributors.id as dbID' 
                        )->where('distributors.id', $arg)
                        ->orderBy('id', 'DESC')->get();
    }






}
