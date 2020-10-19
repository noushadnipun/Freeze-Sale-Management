<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Outlet;
use App\Distributor;

class DistributorController extends Controller
{
    public function index($id = null)
    {
        $getDistributor = Distributor::orderBy('id', 'DESC')->get();
        if(!empty($id)){
            $editDistributor = Distributor::find($id);
        }else{
            $editDistributor = '';
        }

        return view('admin.distributor.index', compact('getDistributor', 'editDistributor'));
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

    public function getTotalOutlet($id)
    {
        $getOutlet = Outlet::where('distributor_id', $id)->get();
        //return view('admin.sale.index', compact('getSale', 'sumTotalRawAmountCount'));
        return view('admin.outlet.index', compact('getOutlet'));
    }
}
