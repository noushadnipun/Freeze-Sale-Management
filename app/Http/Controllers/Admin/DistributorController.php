<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Outlet;
use App\Distributor;
use App\Sale;

class DistributorController extends Controller
{
    public function index($id = null)
    {
        $getDistributor = Distributor::orderBy('id', 'DESC')->paginate('5');
        if(!empty($id)){
            $editDistributor = Distributor::find($id);
        }else{
            $editDistributor = '';
        }

        return view('admin.distributor.index', compact('getDistributor', 'editDistributor'));
    }

    public function getRecord(Request $request, $id = null)
    {
        $getDistributor = Distributor::orderBy('id', 'DESC')->paginate('10');
        if(!empty($id)){
            $editDistributor = Distributor::find($id);
            return view('admin.distributor.edit-data', compact('getDistributor', 'editDistributor'));
        }elseif(!empty($request->search)){
            $getDistributor = Distributor::where('name', 'Like', '%'.$request->search.'%')
                                ->orWhere('mobile', 'Like', '%'.$request->search.'%')
                                ->orWhere('description', 'Like', '%'.$request->search.'%')
                                ->orderBy('id', 'DESC')
                                ->paginate('50');
            $editDistributor = '';
            return view('admin.distributor.data', compact('getDistributor', 'editDistributor'));
        }else{
            $editDistributor = '';
            return view('admin.distributor.data', compact('getDistributor', 'editDistributor'));
        }
    }

    public function store(Request $request)
    {
        $data = new Distributor();
        $data->name = $request->name;
        $data->mobile = $request->mobile;
        $data->description = $request->description;
        $data->save();
        return redirect()->back()->with('success', 'Added Successfully');
    }

    public function update(Request $request)
    {
        $data = Distributor::find($request->id);
        $data->name = $request->name;
        $data->mobile = $request->mobile;
        $data->description = $request->description;
        $data->save();
        return redirect()->back()->with('success', 'Edited Successfully');
    }
    public function destroy($id)
    {
        $data = Distributor::find($id);
        $data->delete();
        return redirect()->route('admin_distributor')->with('delete', 'Deleted Successfully');
    }
    /*
    public function getTotalOutlet($id)
    {
        $getOutlet = Outlet::where('distributor_id', $id)->get();
        //return view('admin.sale.index', compact('getSale', 'sumTotalRawAmountCount'));
        return view('admin.outlet.index', compact('getOutlet'));
    }
    */
    public function getTotalSale($id = null)
    {
        $getSale = Sale::where('db_id', $id)->paginate('20');
        $sumTotalRawAmountCount = $getSale->sum('grand_total');
        $forAjaxUrl = route('admin_distributor_sale', $id);
        return view('admin.sale.index-datatable', compact('getSale', 'sumTotalRawAmountCount'));
    }

    
}
