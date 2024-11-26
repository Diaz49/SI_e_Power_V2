<?php

namespace App\Http\Controllers\PurchaseOrder;

use App\Http\Controllers\Controller;
use App\Models\DetailPo;
use Illuminate\Http\Request;

class DetailPoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([

            'detail_kode_po' => 'required',
            'nama_barang' => 'required',
            'qty' => 'required',
            'satuan' => 'required',
            'harga_satuan' => 'required',
        ]);

        $detail = [
            'po_id' => $request->detail_kode_po,
            'nama_barang' => $request->nama_barang,
            'qty' => $request->qty,
            'satuan' => $request->satuan,
            'harga_satuan' => $request->harga_satuan,
        ];

        DetailPo::create($detail);
        return response()->json();
    }
}
