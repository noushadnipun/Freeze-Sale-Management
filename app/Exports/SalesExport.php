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
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
//
use App\CustomClass\ExportsExcelQuery;


use App\Exports\Sheets\ReportSheets;
use App\Exports\Sheets\TopSheets;

//FromView,  ShouldAutoSize, WithEvents,
class SalesExport implements  WithMultipleSheets
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    /*
    
    public function collection()
    {
        return Sale::all();
    }
   */
    
    public function __construct($excelSearchBoxInput = null, $exceldateFilter = null, $excelOutletFilter = null, $excelDistributorFilter = null){
        $this->exceldateFilter = $exceldateFilter;
        $this->excelSearchBoxInput = $excelSearchBoxInput;
        $this->excelOutletFilter = $excelOutletFilter;
        $this->excelDistributorFilter = $excelDistributorFilter;
        
    }
    
 /*   
    public function view(): View
    {
        $exportsExcelQuery = new ExportsExcelQuery();
        
        if(!empty($this->excelSearchBoxInput)){
            $getSale = $exportsExcelQuery->getSaleSearchBoxInput($this->excelSearchBoxInput);  

        } elseif(!empty($this->exceldateFilter)){        
            $getSale = $exportsExcelQuery->getSaleExceldateFilter($this->exceldateFilter);  

        } elseif(!empty($this->excelOutletFilter)){        
            $getSale = $exportsExcelQuery->getSaleExcelOutletFilter($this->excelOutletFilter);  

        } elseif(!empty($this->excelDistributorFilter)){        
            $getSale = $exportsExcelQuery->getSaleExcelDistributorFilter($this->excelDistributorFilter);  

        } 
        else {
        $getSale = Sale::with('saleItems')
                        ->leftJoin('outlets', 'outlets.id', '=', 'sales.outlet_id')
                        ->leftJoin('distributors', 'distributors.id', '=', 'outlets.distributor_id')
                        ->select('outlets.name as outletName', 'outlets.mobile as outletMobile', 'outlets.address as outletAddress','outlets.visi_id', 'outlets.visi_size',
                                'sales.*', 
                                'distributors.name as dbName', 'distributors.id as dbID' 
                        )->orderBy('id', 'DESC')->get();
        }
        $numRows = count($getSale)+2;
        
        //
        
        //



        $sumTotalRawAmountCount = $getSale->sum('grand_total');
        //return view('admin.sale.index-datatable', compact('getSale', 'sumTotalRawAmountCount'));
        return view('admin.sale.export-excel', compact('getSale', 'sumTotalRawAmountCount', 'numRows') );
    }
    /*
    
    public function headings(): array
    {
        return [
            'Call No',
            'Call Date',
            'Pull Date',
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
/*
    public function registerEvents(): array
    {
       
        return [
         
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
            

                $event->sheet->getStyle('A1:O'.$this->view()->numRows.'')->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);

            },
        ];
    }

*/
    //


    // Sheet
    public function sheets(): array
    {
         if(!empty($this->excelSearchBoxInput)){
            $getSale = Sale::with('saleItems')
                    ->leftJoin('outlets', 'outlets.id', '=', 'sales.outlet_id')
                    ->leftJoin('distributors', 'distributors.id', '=', 'outlets.distributor_id')
                    ->select('outlets.name as outletName', 'outlets.mobile as outletMobile', 'outlets.address as outletAddress','outlets.visi_id', 'outlets.visi_size',
                            'sales.*', 
                            'distributors.name as dbName', 'distributors.id as dbID' 
                    )->where('outlets.name', 'LIKE', '%'.$this->excelSearchBoxInput.'%')
                    ->orWhere('outlets.visi_id', 'LIKE', '%'.$this->excelSearchBoxInput.'%')
                    ->orWhere('outlets.visi_size', 'LIKE', '%'.$this->excelSearchBoxInput.'%')
                    ->orWhere('distributors.name', 'LIKE', '%'.$this->excelSearchBoxInput.'%')
                    ->orWhere('call_no', 'LIKE', '%'.$this->excelSearchBoxInput.'%')
                    //->orwhere('outlets.visi_id',$request->search)
                    //->orwhere('outlets.visi_size',$request->search)
                    ->orderBy('id', 'DESC')->get();

        } elseif(!empty($this->exceldateFilter)){        
            $date = $this->exceldateFilter;
         
            $explode = explode(' - ', $date);
            $getSale = Sale::with('saleItems')->leftJoin('outlets', 'outlets.id', '=', 'sales.outlet_id')
                                        ->leftJoin('distributors', 'distributors.id', '=', 'outlets.distributor_id')
                                        ->select('outlets.name as outletName', 'outlets.mobile as outletMobile', 'outlets.address as outletAddress','outlets.visi_id', 'outlets.visi_size',
                                                'sales.*', 
                                                'distributors.name as dbName', 'distributors.id as dbID' 
                                        )//->whereBetween('sales.created_at', array($explode[0], $explode[1]))
                                        ->whereBetween('sales.call_date', array($explode[0], $explode[1]))
                                        ->orderBy('id', 'DESC')->get();

        } elseif(!empty($this->excelOutletFilter)){        
            $getSale = Sale::with('saleItems')
                        ->leftJoin('outlets', 'outlets.id', '=', 'sales.outlet_id')
                        ->leftJoin('distributors', 'distributors.id', '=', 'outlets.distributor_id')
                        ->select('outlets.name as outletName', 'outlets.mobile as outletMobile', 'outlets.address as outletAddress','outlets.visi_id', 'outlets.visi_size',
                                'sales.*', 
                                'distributors.name as dbName', 'distributors.id as dbID' 
                        )->where('outlet_id', $this->excelOutletFilter)
                        ->orderBy('id', 'DESC')->get();

        } elseif(!empty($this->excelDistributorFilter)){        
            $getSale =  Sale::with('saleItems')
                        ->leftJoin('outlets', 'outlets.id', '=', 'sales.outlet_id')
                        ->leftJoin('distributors', 'distributors.id', '=', 'outlets.distributor_id')
                        ->select('outlets.name as outletName', 'outlets.mobile as outletMobile', 'outlets.address as outletAddress','outlets.visi_id', 'outlets.visi_size',
                                'sales.*', 
                                'distributors.name as dbName', 'distributors.id as dbID' 
                        )->where('distributors.id', $this->excelDistributorFilter)
                        ->orderBy('id', 'DESC')->get();

        }
        else {
    
        $getSale = Sale::with('saleItems')
                        ->leftJoin('outlets', 'outlets.id', '=', 'sales.outlet_id')
                        ->leftJoin('distributors', 'distributors.id', '=', 'outlets.distributor_id')
                        ->select('outlets.name as outletName', 'outlets.mobile as outletMobile', 'outlets.address as outletAddress','outlets.visi_id', 'outlets.visi_size',
                                'sales.*', 
                                'distributors.name as dbName', 'distributors.id as dbID' 
                        )->orderBy('id', 'DESC')->get();
        };
        $getCount = $getSale->count();
        $perPage = 20;
        $ceilPage = ceil($getCount / $perPage);
        $lastCount =  $getCount%$perPage;


        $sheets = [];
        
        for ($i=0; $i < $ceilPage; $i++) {
            $page = $i;
            $take = $i == ($ceilPage -1) && $lastCount != 0 ? $lastCount : $perPage;


            $sheets[] = new ReportSheets(
                    $this->excelSearchBoxInput, 
                    $this->exceldateFilter, 
                    $this->excelOutletFilter,  
                    $this->excelDistributorFilter,
                    $page,
                    $perPage,
                    $take
                );
        }

            $sheets[] = new TopSheets($this->excelSearchBoxInput, 
                    $this->exceldateFilter, 
                    $this->excelOutletFilter,  
                    $this->excelDistributorFilter,
                    $getSale, $perPage, $page, $take);

            
            // $sheets = [
            //     $reportSheet++,
            //     $topSheet,
            // ];
        // $sheets = [
        //     new ReportSheets($this->excelSearchBoxInput, $this->exceldateFilter, $this->excelOutletFilter,  $this->excelDistributorFilter),
        //     new TopSheets(),
        // ];
       
        return $sheets;
       
        
    }


    //
      

}
