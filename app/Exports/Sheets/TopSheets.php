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

class TopSheets implements FromView,  ShouldAutoSize, WithTitle, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    /*
    public function collection()
    {
        return Outlet::all();
    }
    */

    public function __construct($excelSearchBoxInput = null, 
                                $exceldateFilter = null,                                                           
                                $excelOutletFilter = null,                                                                                
                                $excelDistributorFilter = null, 
                                $getSale, $perPage, $page, $take){
        
        $this->exceldateFilter = $exceldateFilter;
        $this->excelSearchBoxInput = $excelSearchBoxInput;
        $this->excelOutletFilter = $excelOutletFilter;
        $this->excelDistributorFilter = $excelDistributorFilter;
        $this->getSale = $getSale;
        $this->perPage = $perPage;

      
        $this->page = $page;
        $this->take = $take;
    }

     public function view(): View
    {
        $exportsExcelQuery = new ExportsExcelQuery();

        $totalSaleCount = $this->getSale->count();
        $itemPerPage = $this->perPage;
        $ceilPage = ceil($totalSaleCount / $itemPerPage);
        
        $lastItemCount = $totalSaleCount % $itemPerPage;

        $lastCount =  $totalSaleCount%$itemPerPage;

        for ($i=0; $i < $ceilPage; $i++) {
            $this->page = $i;
            $this->take = $i == ($ceilPage -1) && $lastCount != 0 ? $lastCount : $this->perPage;

            $skip = $this->page??0 * $this->perPage??10;
            $take = $this->take??10;

            $getSale = $this->getSale;
            
        
        //$sumTotalRawAmountCount = $this->$getSale->sum('grand_total');
        }
        return view('admin.sale.export-excel-top-sheet', compact('getSale','ceilPage','lastItemCount','itemPerPage'));
    }


      public function registerEvents(): array
        {
        
        //dd($numRows);
            return [
            
                AfterSheet::class    => function(AfterSheet $event) {
                    $event->sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
                
                    $numRows = number_format($this->view()->ceilPage)+12;
                    $event->sheet->getStyle('A9:D'.$numRows.'')->applyFromArray([
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
     //
    public function title(): string
    {
        return 'Top Sheet';
    }
}
