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


class SaleController extends Controller
{
    //
    public function index(Request $request)
    {
        $getSale = Sale::orderBy('id', 'DESC')->paginate('20');
        $sumTotalRawAmountCount = $getSale->sum('grand_total');
        return view('admin.sale.index', compact('getSale', 'sumTotalRawAmountCount'));
    }

    //
    public function create($id = null)
    {
        $saleValue ='';
        return view('admin.sale.form', compact('saleValue'));
    }
    public function edit($id)
    {
        $saleValue = Sale::find($id);
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
       

    }
    //

}
