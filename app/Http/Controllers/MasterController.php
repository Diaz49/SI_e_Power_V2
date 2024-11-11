<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function data_project()
    {
        return view('master.data_project_id');
    }

    public function data_client() 
    {
        return view('master.data_client');
    }

    public function data_vendor()
    {
        return view('master.data_vendor');
    }

    public function data_bank()
    {
        return view('master.data_bank');
    }
}
