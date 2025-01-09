<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class PrintInvoiceController extends Controller
{
    public function view(string $id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('invoice.print')->with('invoice', $invoice);
    }
}
