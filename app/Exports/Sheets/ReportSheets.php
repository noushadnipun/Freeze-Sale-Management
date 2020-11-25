<?php

namespace App\Exports\Sheets;

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
use Maatwebsite\Excel\Concerns\WithTitle;


use App\Sale;
use App\CustomClass\ExportsExcelQuery;

class ReportSheets implements FromView,  ShouldAutoSize, WithEvents, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    /*
    public function collection()
    {
        //
    }
    */
     public function __construct($excelSearchBoxInput = null, $exceldateFilter = null, 
                                                              $excelOutletFilter = null, 
                                                              $excelDistributorFilter = null,
                                                              $page,
                                                              $perPage,
                                                              $take){
        $this->exceldateFilter = $exceldateFilter;
        $this->excelSearchBoxInput = $excelSearchBoxInput;
        $this->excelOutletFilter = $excelOutletFilter;
        $this->excelDistributorFilter = $excelDistributorFilter;
        $this->page = $page;
        $this->perPage = $perPage;
        $this->take = $take;

    }
    
    
    public function view(): View
    {
        $exportsExcelQuery = new ExportsExcelQuery();
        $skip = $this->page??0 * $this->perPage??10;
        $take = $this->take??10;
        $getSerialNumber = $skip * $this->perPage;
        
        if(!empty($this->excelSearchBoxInput)){
            $getSale = $exportsExcelQuery->getSaleSearchBoxInput($this->excelSearchBoxInput, $skip, $take);  

        } elseif(!empty($this->exceldateFilter)){        
            $getSale = $exportsExcelQuery->getSaleExceldateFilter($this->exceldateFilter, $skip, $take);  

        } elseif(!empty($this->excelOutletFilter)){        
            $getSale = $exportsExcelQuery->getSaleExcelOutletFilter($this->excelOutletFilter, $skip, $take);  

        } elseif(!empty($this->excelDistributorFilter)){        
            $getSale = $exportsExcelQuery->getSaleExcelDistributorFilter($this->excelDistributorFilter, $skip, $take);  

        } 
        else {
       
        $getSale = Sale::with('saleItems')
                        ->leftJoin('outlets', 'outlets.id', '=', 'sales.outlet_id')
                        ->leftJoin('distributors', 'distributors.id', '=', 'outlets.distributor_id')
                        ->select('outlets.name as outletName', 'outlets.mobile as outletMobile', 'outlets.address as outletAddress','outlets.visi_id', 'outlets.visi_size',
                                'sales.*', 
                                'distributors.name as dbName', 'distributors.id as dbID' 
                        )->orderBy('id', 'DESC')->skip($skip)->take($take)->get();
        }
        $numRows = count($getSale)+2;
        
        $sumTotalRawAmountCount = $getSale->sum('grand_total');
        //return view('admin.sale.index-datatable', compact('getSale', 'sumTotalRawAmountCount'));
        return view('admin.sale.export-excel', compact('getSale', 'sumTotalRawAmountCount', 'numRows', 'getSerialNumber') );
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


    //
    public function title(): string
    {
        return 'Bill Sheet';
    }

}
