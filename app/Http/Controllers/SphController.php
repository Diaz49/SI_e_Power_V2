<?php

namespace App\Http\Controllers;

use App\DataTables\SphDataTable;
use App\Http\Controllers\Controller;
use App\Models\Sph;
use Illuminate\Http\Request;

class SphController extends Controller
{

    public function index(SphDataTable $dataTable)
    {
        return $dataTable->render('sph.index');
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
            'header.kode_purchase_order.required' => 'Kode purchase order wajib diisi.',
            'header.kode_purchase_order.max' => 'Kode purchase order maksimal 100 karakter.',
            'header.kode_purchase_order.unique' => 'Kode purchase order sudah terdaftar.',

            'header.tanggal.required' => 'Tanggal wajib diisi.',
            'header.tanggal.date' => 'Tanggal harus dalam format yang valid.',

            'header.nama_vendor.required' => 'Nama vendor wajib diisi.',

            'header.nama_buyer.required' => 'Nama buyer wajib diisi.',
            'header.nama_buyer.max' => 'Nama buyer maksimal 50 karakter.',

            'header.perihal.string' => 'Perihal harus berupa teks.',

            'header.catatan.string' => 'Catatan harus berupa teks.',

            'header.catatan_2.string' => 'Catatan 2 harus berupa teks.',

            'header.diskon_rupiah.numeric' => 'Diskon rupiah harus berupa angka.',
            'header.diskon_rupiah.min' => 'Diskon rupiah tidak boleh kurang dari 0.',
            'header.diskon_rupiah.max' => 'Diskon rupiah maksimal 9999999999.99.',

            'details.*.nama_barang.required' => 'Nama barang pada detail wajib diisi.',
            'details.*.nama_barang.string' => 'Nama barang pada detail harus berupa teks.',
            'details.*.nama_barang.max' => 'Nama barang pada detail maksimal 255 karakter.',

            'details.*.qty.required' => 'Jumlah barang pada detail wajib diisi.',
            'details.*.qty.integer' => 'Jumlah barang pada detail harus berupa angka.',
            'details.*.qty.min' => 'Jumlah barang pada detail minimal 1.',

            'details.*.satuan.required' => 'Satuan barang pada detail wajib diisi.',
            'details.*.satuan.string' => 'Satuan barang pada detail harus berupa teks.',
            'details.*.satuan.max' => 'Satuan barang pada detail maksimal 50 karakter.',

            'details.*.harga_satuan.required' => 'Harga satuan barang wajib diisi.',
            'details.*.harga_satuan.numeric' => 'Harga satuan barang harus berupa angka.',
            'details.*.harga_satuan.min' => 'Harga satuan barang tidak boleh kurang dari 0.',
        ]);
        DB::beginTransaction(); // Mulai transaksi
        // Simpan data header

        try {

            $sph = Sph::create([
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
                $jumlah_harga = $detail['qty'] * $detail['harga_satuan'];
                $po->detail()->create([
                    'nama_barang' => $detail['nama_barang'],
                    'qty' => $detail['qty'],
                    'satuan' => $detail['satuan'],
                    'harga_satuan' => $detail['harga_satuan'],
                    'jumlah_harga' => $jumlah_harga,
                ]);
            }
            DB::commit();
            return response()->json(['message' => 'Purchase order berhasil disimpan.']);
        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan semua perubahan jika ada error
            return response()->json(['message' => 'Gagal menyimpan purchase order: ' . $e->getMessage()], 500);
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
