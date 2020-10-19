<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service;

class ServiceController extends Controller
{
    public function index($id = null)
    {
        $getService = Service::orderBy('id', 'DESC')->get();
        if(!empty($id)){
            $editService = Service::find($id);
        }
        return view('admin.service.index', compact('getService', 'editService'));
    }

    public function store(Request $request)
    {
        $data = new Service();
        $data->name = $request->name;
        $data->rate = $request->rate;
        $data->save();
        return redirect()->back()->with('success', 'Added Successfully');
    }

    public function update(Request $request)
    {
        $data = Service::find($request->id);
        $data->name = $request->name;
        $data->rate = $request->rate;
        $data->save();
        return redirect()->back()->with('success', 'Edited Successfully');
    }
    public function destroy($id)
    {
        $data = Service::find($id);
        $data->delete();
        return redirect()->route('admin_service')->with('delete', 'Deleted Successfully');
    }
}
