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
            'header.kode_purchase_order' => 'required|max:100|unique:po,kode_po',
            'header.tanggal' => 'required|date',
            'header.nama_vendor' => 'required',
            'header.nama_buyer' => 'required|max:50',
            'header.perihal' => 'nullable|string',
            'header.catatan' => 'nullable|string',
            'header.catatan_2' => 'nullable|string',
            'header.diskon_rupiah' => 'nullable|numeric|min:0|max:9999999999.99',
            'details.*.nama_barang' => 'required|string|max:255',
            'details.*.qty' => 'required|integer|min:1',
            'details.*.satuan' => 'required|string|max:50',
            'details.*.harga_satuan' => 'required|numeric|min:0',
        ], [
            'details.*.nama_barang.required' => 'Nama barang pada detail wajib diisi.',
            'details.*.qty.required' => 'Jumlah barang pada detail wajib diisi.',
            'details.*.satuan.required' => 'Satuan barang pada detail wajib diisi.',
            'details.*.harga_satuan.required' => 'Harga satuan barang wajib diisi.',
        ]);
    
        // Simpan data header
        $po = Po::create([
            'kode_po' => $request->input('header.kode_purchase_order'),
            'tanggal_po' => $request->input('header.tanggal'),
            'vendor_id' => $request->input('header.nama_vendor'),
            'buyer' => $request->input('header.nama_buyer'),
            'perihal' => $request->input('header.perihal'),
            'catatan' => $request->input('header.catatan'),
            'catatan_2' => $request->input('header.catatan_2'),
            'diskon' => $request->input('header.diskon_rupiah'),
        ]);
    
        // Simpan data detail
        foreach ($request->input('details') as $detail) {
            $po->detail()->create([
                'nama_barang' => $detail['nama_barang'],
                'qty' => $detail['qty'],
                'satuan' => $detail['satuan'],
                'harga_satuan' => $detail['harga_satuan'],
            ]);
        }
    
        return response()->json(['message' => 'Purchase order berhasil disimpan.']);
    }
    
    public function destroy(string $id)
    {
        $po = Po::find($id);
        $po->delete();
        return response()->json();
    }
}
