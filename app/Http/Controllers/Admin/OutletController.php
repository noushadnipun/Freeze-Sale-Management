<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Outlet;
use App\Sale;
use App\SaleItem;

class OutletController extends Controller
{
    public function index($id = null)
    {
        $getOutlet = Outlet::orderBy('id', 'DESC')->get();
        if(!empty($id)){
            $editOutlet = Outlet::find($id);
        }else{
            $editOutlet = '';
        }

        return view('admin.outlet.index', compact('getOutlet', 'editOutlet'));
    }

    public function store(Request $request)
    {
        $data = new Outlet();
        $data->name = $request->name;
        $data->address = $request->address;
        $data->mobile = $request->mobile;
        $data->distributor_id = $request->distributor_id;
        $data->save();
        return redirect()->back()->with('success', 'Added Successfully');
    }

    public function update(Request $request)
    {
        $data = Outlet::find($request->id);
        $data->name = $request->name;
        $data->address = $request->address;
        $data->mobile = $request->mobile;
        $data->distributor_id = $request->distributor_id;
        $data->save();
        return redirect()->back()->with('success', 'Edited Successfully');
    }
    public function destroy($id)
    {
        $data = Outlet::find($id);
        $data->delete();
        return redirect()->route('admin_outlet')->with('delete', 'Deleted Successfully');
    }

    public function getTotalSale($id)
    {
        $getSale = Sale::where('outlet_id', $id)->paginate('20');
        $sumTotalRawAmountCount = $getSale->sum('grand_total');
        return view('admin.sale.index', compact('getSale', 'sumTotalRawAmountCount'));
    }

}
