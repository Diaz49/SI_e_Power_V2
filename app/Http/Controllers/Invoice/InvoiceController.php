<?php

namespace App\Http\Controllers\Invoice;

use App\DataTables\InvoiceDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(InvoiceDataTable $dataTable){
        return $dataTable->render('invoice.index');
    }
}
