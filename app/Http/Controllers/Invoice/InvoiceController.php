<?php

namespace App\Http\Controllers\Invoice;

use App\DataTables\InvoiceDataTable;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\DataClient;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(InvoiceDataTable $dataTable){
        $client = DataClient::all();
        $bank = Bank::all();
        return $dataTable->render('invoice.index', compact('client', 'bank'));
    }
}
