<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Outlet;
use App\Service;
use App\Distributor;

class ApiController extends Controller
{
    public function outlet()
    {
        return Outlet::orderBy('id', 'DESC')->get();
    }

    public function service($id = null)
    {
        if(!empty($id)){
            return Service::where('id', $id)->orderBy('id', 'DESC')->first();
        }else{
            return Service::orderBy('id', 'DESC')->get();
        }
        
    }

    public function distributor()
    {
        return Distributor::orderBy('id', 'DESC')->get();
    }
}
