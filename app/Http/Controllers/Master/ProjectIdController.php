<?php

namespace App\Http\Controllers\Master;

use App\DataTables\Master\DataProjectIdDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use function Termwind\render;

class ProjectIdController extends Controller
{
    public function index(DataProjectIdDataTable $dataTable){
        return $dataTable->render('master.data_project_id');
    }
}
