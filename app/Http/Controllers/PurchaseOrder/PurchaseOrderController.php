<?php

namespace App\Http\Controllers\PurchaseOrder;

use App\DataTables\PurchaseOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\DataVendor;
use App\Models\Po;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index(PurchaseOrderDataTable $dataTable)
    {
        $vendor = DataVendor::all();
        return $dataTable->render('po.index', compact('vendor'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_purchase_order' => 'required',
            'tanggal' => 'required',
            'nama_vendor' => 'required',
            'nama_buyer' => 'required',
            'perihal' => 'required',
            'catatan' => 'required',
            'catatan_2' => 'required',
            'diskon_rupiah' => 'required',
        ]);
        $po = [
            'kode_po' => $request->kode_purchase_order,
            'tanggal_po' => $request->tanggal,
            'vendor_id' => $request->nama_vendor,
            'buyer' => $request->nama_buyer,
            'perihal' => $request->perihal,
            'catatan' => $request->catatan,
            'catatan_2' => $request->catatan_2,
            'diskon' => $request->diskon_rupiah,
        ];
        Po::create($po);
        return response()->json();
    }
}
