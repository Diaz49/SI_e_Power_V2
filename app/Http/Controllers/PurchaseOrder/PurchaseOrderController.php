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
            'kode_purchase_order' => 'required|max:100|unique:po,kode_po',
            'tanggal' => 'required|date',
            'nama_vendor' => 'required', // Asumsi 'vendors' adalah tabel vendor
            'nama_buyer' => 'required|max:50',
            'perihal' => 'nullable|string',
            'catatan' => 'nullable|string',
            'catatan_2' => 'nullable|string',
            'diskon_rupiah' => 'nullable|numeric|min:0|max:9999999999.99',
        ], [
            'kode_purchase_order.required' => 'Kode purchase order wajib diisi.',
            'kode_purchase_order.max' => 'Kode purchase order tidak boleh lebih dari 100 karakter.',
            'kode_purchase_order.unique' => 'Kode purchase order sudah digunakan.',

            'tanggal.required' => 'Tanggal wajib diisi.',
            'tanggal.date' => 'Tanggal harus berupa format tanggal yang valid.',

            'nama_vendor.required' => 'Nama vendor wajib dipilih.',
            'nama_vendor.exists' => 'Vendor yang dipilih tidak ditemukan.',

            'nama_buyer.required' => 'Nama buyer wajib diisi.',
            'nama_buyer.max' => 'Nama buyer tidak boleh lebih dari 50 karakter.',

            'perihal.string' => 'Perihal harus berupa teks.',

            'catatan.string' => 'Catatan harus berupa teks.',

            'catatan_2.string' => 'Catatan 2 harus berupa teks.',

            'diskon_rupiah.numeric' => 'Diskon harus berupa angka.',
            'diskon_rupiah.min' => 'Diskon tidak boleh bernilai negatif.',
            'diskon_rupiah.max' => 'Diskon tidak boleh melebihi batas maksimal.',
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

        $createdPo = Po::create($po);

        return response()->json(['id' => $createdPo->id]);
    }
}
