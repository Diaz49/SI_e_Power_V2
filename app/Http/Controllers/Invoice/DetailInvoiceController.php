<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Models\DetailInvoice;
use App\Models\Invoice;
use Illuminate\Http\Request;

class DetailInvoiceController extends Controller
{
    public function table(string $id)
    {
        $invoice = Invoice::with('detail')->findOrFail($id);

        // Kirim data ke view dalam bentuk JSON untuk ditampilkan di modal
        return response()->json([
            'invoice' => $invoice,
            'detail' => $invoice->detail
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'add_nama_barang' => 'required|string|max:255',
            'add_qty' => 'required|integer|min:1',
            'add_satuan' => 'required|string|max:50',
            'add_harga_satuan' => 'required|numeric|min:0',
        ], [
            'add_nama_barang.required' => 'Nama barang pada detail wajib diisi.',
            'add_nama_barang.string' => 'Nama barang pada detail harus berupa teks.',
            'add_nama_barang.max' => 'Nama barang pada detail maksimal 255 karakter.',

            'add_qty.required' => 'Jumlah barang pada detail wajib diisi.',
            'add_qty.integer' => 'Jumlah barang pada detail harus berupa angka.',
            'add_qty.min' => 'Jumlah barang pada detail minimal 1.',

            'add_satuan.required' => 'Satuan barang pada detail wajib diisi.',
            'add_satuan.string' => 'Satuan barang pada detail harus berupa teks.',
            'add_satuan.max' => 'Satuan barang pada detail maksimal 50 karakter.',

            'add_harga_satuan.required' => 'Harga satuan barang wajib diisi.',
            'add_harga_satuan.numeric' => 'Harga satuan barang harus berupa angka.',
            'add_harga_satuan.min' => 'Harga satuan barang tidak boleh kurang dari 0.',
        ]);
        $data = [
            'invoice_id' => $request->add_invoice_id,
            'nama_barang' => $request->add_nama_barang,
            'qty' => $request->add_qty,
            'satuan' => $request->add_satuan,
            'harga_satuan' => $request->add_harga_satuan,
            'jumlah_harga' => $request->add_qty * $request->add_harga_satuan
        ];
        DetailInvoice::create($data);
        return response()->json();
    }
    public function edit(string $id)
    {
        $detail = DetailInvoice::find($id);
        return response()->json($detail);
    }
    public function update(Request $request, string $id)
    {
        $detail = DetailInvoice::find($id);
        $request->validate([
            'edit_nama_barang' => 'required|string|max:255',
            'edit_qty' => 'required|integer|min:1',
            'edit_satuan' => 'required|string|max:50',
            'edit_harga_satuan' => 'required|numeric|min:0',
        ], [
            'edit_nama_barang.required' => 'Nama barang pada detail wajib diisi.',
            'edit_nama_barang.string' => 'Nama barang pada detail harus berupa teks.',
            'edit_nama_barang.max' => 'Nama barang pada detail maksimal 255 karakter.',

            'edit_qty.required' => 'Jumlah barang pada detail wajib diisi.',
            'edit_qty.integer' => 'Jumlah barang pada detail harus berupa angka.',
            'edit_qty.min' => 'Jumlah barang pada detail minimal 1.',

            'edit_satuan.required' => 'Satuan barang pada detail wajib diisi.',
            'edit_satuan.string' => 'Satuan barang pada detail harus berupa teks.',
            'edit_satuan.max' => 'Satuan barang pada detail maksimal 50 karakter.',

            'edit_harga_satuan.required' => 'Harga satuan barang wajib diisi.',
            'edit_harga_satuan.numeric' => 'Harga satuan barang harus berupa angka.',
            'edit_harga_satuan.min' => 'Harga satuan barang tidak boleh kurang dari 0.',
        ]);

        $data = [
            'nama_barang' => $request->edit_nama_barang,
            'qty' => $request->edit_qty,
            'satuan' => $request->edit_satuan,
            'harga_satuan' => $request->edit_harga_satuan,
            'jumlah_harga' => $request->edit_qty * $request->edit_harga_satuan,
        ];

        $detail->update($data);
        return response()->json($data);
    }
    public function destroy(string $id)
    {
        $detail = DetailInvoice::findOrFail($id);
        $detail->delete();
        return response()->json();
    }
}
