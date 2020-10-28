<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Redirect,Response;
use App\Sale;
use App\SaleItem;
use App\Service;
use App\Outlet;
use DB;
use App\Exports\SalesExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class SaleController extends Controller
{
    //
    public function index(Request $request)
    {
         return view('admin.sale.index');
    }

     //
    public function getRecord()
    {
        //$getSale = Sale::orderBy('id', 'DESC')->paginate('1');
        $getSale = Sale::with('saleItems')
                        ->leftJoin('outlets', 'outlets.id', '=', 'sales.outlet_id')
                        ->leftJoin('distributors', 'distributors.id', '=', 'outlets.distributor_id')
                        ->select('outlets.name as outletName', 'outlets.mobile as outletMobile', 'outlets.address as outletAddress','outlets.visi_id', 'outlets.visi_size',
                                'sales.*', 
                                'distributors.name as dbName', 'distributors.id as dbID' 
                        )->orderBy('id', 'DESC')->paginate('20');
        //dd($getSale);
        $sumTotalRawAmountCount = $getSale->sum('grand_total');
        return view('admin.sale.index-datatable', compact('getSale', 'sumTotalRawAmountCount'));
        
    }

    //
    public function create($id = null)
    {
        $saleValue ='';
        return view('admin.sale.form', compact('saleValue'));
    }
    public function edit($id)
    {
        //$saleValue = Sale::find($id);
        $saleValue = self::getRecord()->getSale->find($id);
        return view('admin.sale.form', compact('saleValue'));
    }

    //

    public function store(Request $request)
    {
        $data = $request->all();
        $lastid = Sale::create($data)->id;
        if(count($request->service_id) >0 ){
            foreach($request->service_id as $item=>$v){
                 $data2 = array(
                      'sales_id' => $lastid,
                      'service_id' => $request->service_id[$item],
                      'service_qty' => $request->service_qty[$item],
                    //   'total_paid' => $request->total_paid[$item],
                    //   'total_due' => $request->total_due[$item],
                 );
               SaleItem::insert($data2);
               //dd($data2);
            }
        }
        return redirect()->route('admin_sale')->with('success', 'Added Successfully.'); 
    }

    //

    public function update(Request $request)
    {
        $data = $request->all();
        $lastid = Sale::find($request->id)->update($data);
        //$saleItemRowCount = SaleItem::where('sales_id', $request->id)->count();

        for ($i=0; $i<count($request->item_id); $i++) {
            $data2 = [
                'sales_id' => $request->id,
                'service_id' => $request->service_id[$i],
                'service_qty' => $request->service_qty[$i],      
            ];
            //SaleItem::where('id', $request->item_id[$i])->update($data2);       
            SaleItem::where('id', $request->item_id[$i])->update($data2);       
        }  
        return redirect()->back()->with('success', 'Edited Successfully.'); 
    }

    //
    public function destroy(Request $request, $id)
    {
        $sale = Sale::find($id);
        $sale->delete();
        $item = SaleItem::where('sales_id', $request->id);
        $item->delete();
        return redirect()->back()->with('delete', 'Deleted Successfully.'); 
    }
    //

    public function ajaxSearch(Request $request)
    {
        $getSale = Sale::with('saleItems')
                        ->leftJoin('outlets', 'outlets.id', '=', 'sales.outlet_id')
                        ->leftJoin('distributors', 'distributors.id', '=', 'outlets.distributor_id')
                        ->select('outlets.name as outletName', 'outlets.mobile as outletMobile', 'outlets.address as outletAddress','outlets.visi_id', 'outlets.visi_size',
                                'sales.*', 
                                'distributors.name as dbName', 'distributors.id as dbID' 
                        )->where('outlets.name', 'Like', '%'.$request->search.'%')
                        ->orWhere('outlets.visi_id', 'Like', '%'.$request->search.'%')
                        ->orWhere('outlets.visi_size', 'Like', '%'.$request->search.'%')
                        ->orWhere('distributors.name', 'Like', '%'.$request->search.'%')
                        ->orderBy('id', 'DESC')->paginate('20');
        $sumTotalRawAmountCount = $getSale->sum('grand_total');
        //return $getSale;
        return view('admin.sale.index-datatable', compact('getSale', 'sumTotalRawAmountCount'));

    }
        // Filter

        public function filterOutlet($id)
        {
            $getSale = self::getRecord()->getSale->where('outlet_id', $id);
            $sumTotalRawAmountCount = $getSale->where('outlet_id', $id)->sum('grand_total');
            //dd($getSale);
            return view('admin.sale.index-datatable', compact('getSale', 'sumTotalRawAmountCount'));
        }

        //

         public function filterDistributor($id)
        {
            $getSale = self::getRecord()->getSale->where('dbID', $id);
            $sumTotalRawAmountCount = $getSale->where('db_id', $id)->sum('grand_total');
            //dd($getSale);
            return view('admin.sale.index-datatable', compact('getSale', 'sumTotalRawAmountCount'));
        }


        public function filterDate($datefilter)
        {
            $date = $datefilter;
            $explode = explode(' - ', $date);
            $getSale = Sale::with('saleItems')
                        ->leftJoin('outlets', 'outlets.id', '=', 'sales.outlet_id')
                        ->leftJoin('distributors', 'distributors.id', '=', 'outlets.distributor_id')
                        ->select('outlets.name as outletName', 'outlets.mobile as outletMobile', 'outlets.address as outletAddress','outlets.visi_id', 'outlets.visi_size',
                                'sales.*', 
                                'distributors.name as dbName', 'distributors.id as dbID' 
                        )->whereBetween('sales.created_at', array($explode[0], $explode[1]))
                        ->orderBy('id', 'DESC')->paginate('20');
            $sumTotalRawAmountCount = $getSale->sum('grand_total');
            return view('admin.sale.index-datatable', compact('getSale', 'sumTotalRawAmountCount'));
        }





    //Excel
    public function exportExcel()
    {
        return Excel::download(new SalesExport, 'sales.xlsx');
    }
    
    //pfd
    public function downloadPDF() {
        $getSale = self::getRecord()->getSale;
        $sumTotalRawAmountCount = $getSale->sum('grand_total');
        $pdf = PDF::loadView('admin.sale.index-datatable', compact('getSale', 'sumTotalRawAmountCount'))
                ->setPaper('a4', 'landscape')->setWarnings(false);
    //return $pdf->download('report.pdf');
    return $pdf->stream();
    //return view('admin.sale.index-datatable', compact('getSale', 'sumTotalRawAmountCount'));
}

    
    
    //

}
