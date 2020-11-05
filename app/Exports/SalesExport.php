<?php

namespace App\Exports;

use App\Sale;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalesExport implements  FromView, ShouldAutoSize
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
                        ->leftJoin('distributors', 'distributors.id', '=', 'outlets.distributor_id')
                        ->select('outlets.name as outletName', 'outlets.mobile as outletMobile', 'outlets.address as outletAddress','outlets.visi_id', 'outlets.visi_size',
                                'sales.*', 
                                'distributors.name as dbName', 'distributors.id as dbID' 
                        )->orderBy('id', 'DESC')->get();
        //dd($getSale);
        $sumTotalRawAmountCount = $getSale->sum('grand_total');
        //return view('admin.sale.index-datatable', compact('getSale', 'sumTotalRawAmountCount'));
        return view('admin.sale.export-excel', compact('getSale', 'sumTotalRawAmountCount') );
    }
    /*
    public function headings(): array
    {
        return [
            'Call No',
            'Call Date',
            'Visi ID',
            'Visi Size',
            'Outlet Name',
            'Address & Cell No',
            'DB Name',
            'Work Details',
            'Qty',
            'Rate',
            'Taka',
            'Total Amount',
            'Delivery Date'
        ];
    }
    */

}
