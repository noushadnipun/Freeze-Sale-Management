<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Outlet;
use App\Service;

class ApiController extends Controller
{
    public function outlet()
    {
        return Outlet::get();
    }

    public function service()
    {
        return Service::get();
    }
}
