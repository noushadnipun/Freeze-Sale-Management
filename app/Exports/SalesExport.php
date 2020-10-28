<?php

namespace App\Exports;

use App\Sale;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class SalesExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    /*
    public function collection()
    {
        return Sale::all();
    }
   */

    public function view(): View
    {
        $getSale = Sale::with('saleItems')
            ->leftJoin('outlets', 'outlets.id', '=', 'sales.outlet_id')
            ->leftJoin('distributors', 'distributors.id', '=', 'sales.db_id')
            ->select('outlets.name as outletName', 'outlets.mobile as outletMobile', 'outlets.address as outletAddress','outlets.visi_id', 'outlets.visi_size',
                    'sales.*', 
                    'distributors.name as dbName' 
            )
            ->orderBy('id', 'DESC')->paginate('20');
        //dd($getSale);
        $sumTotalRawAmountCount = $getSale->sum('grand_total');
        return view('admin.sale.export-excel', compact('getSale', 'sumTotalRawAmountCount') );
    }

/*
    public function query()
    {
        return Sale::with('saleItems')
            ->leftJoin('outlets', 'outlets.id', '=', 'sales.outlet_id')
            ->leftJoin('distributors', 'distributors.id', '=', 'sales.db_id')
            ->select('outlets.name as outletName', 'outlets.mobile as outletMobile', 'outlets.address as outletAddress','outlets.visi_id', 'outlets.visi_size',
                    'sales.*', 
                    'distributors.name as dbName' 
            )
            ->orderBy('id', 'DESC')->paginate('20');
    }
   */


}
