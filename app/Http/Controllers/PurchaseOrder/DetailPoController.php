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
            'po_id' => 'required|exists:po,id',
            'nama_barang' => 'required|string|max:100',
            'qty' => 'required|integer|min:1',
            'satuan' => 'required|string|max:50',
            'harga_satuan' => 'required|numeric|min:0|max:9999999999.99',
        ], [
            'po_id.required' => 'ID PO wajib diisi.',
            'po_id.exists' => 'ID PO yang dipilih tidak ditemukan.',

            'nama_barang.required' => 'Nama barang wajib diisi.',
            'nama_barang.string' => 'Nama barang harus berupa teks.',
            'nama_barang.max' => 'Nama barang tidak boleh lebih dari 100 karakter.',

            'qty.required' => 'Kuantitas barang wajib diisi.',
            'qty.integer' => 'Kuantitas barang harus berupa angka bulat.',
            'qty.min' => 'Kuantitas barang minimal 1.',

            'satuan.required' => 'Satuan barang wajib diisi.',
            'satuan.string' => 'Satuan barang harus berupa teks.',
            'satuan.max' => 'Satuan barang tidak boleh lebih dari 50 karakter.',

            'harga_satuan.required' => 'Harga satuan barang wajib diisi.',
            'harga_satuan.numeric' => 'Harga satuan harus berupa angka.',
            'harga_satuan.min' => 'Harga satuan tidak boleh bernilai negatif.',
            'harga_satuan.max' => 'Harga satuan tidak boleh melebihi batas maksimal.',
        ]);


        $detail = [
            'po_id' => $request->po_id,
            'nama_barang' => $request->nama_barang,
            'qty' => $request->qty,
            'satuan' => $request->satuan,
            'harga_satuan' => $request->harga_satuan,
        ];

        DetailPo::create($detail);
        return response()->json();
    }
}
