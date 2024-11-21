<?php

namespace App\Http\Controllers;

use App\DataTables\PurchaseOrderDataTable;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index(PurchaseOrderDataTable $dataTable){
        return $dataTable->render('po.index');
    }
}
