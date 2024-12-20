<?php

namespace App\Http\Controllers\SPH;

use App\Http\Controllers\Controller;
use App\Models\DetailSPH;
use App\Models\Sph;
use Illuminate\Http\Request;

class DetailSphController extends Controller
{
    public function table(string $id)
    {
        $sph = Sph::with('detailSph')->findOrFail($id);

        // Kirim data ke view dalam bentuk JSON untuk ditampilkan di modal
        return response()->json([
            'sph' => $sph,
            'detailSph' => $sph->detailSph
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'add_nama_project' => 'required|string|max:255',
            'add_qty' => 'required|integer|min:1',
            'add_satuan' => 'required|string|max:50',
            'add_harga_satuan' => 'required|numeric|min:0',
        ], [
            'add_nama_project.required' => 'Nama project pada detail wajib diisi.',
            'add_nama_project.string' => 'Nama project pada detail harus berupa teks.',
            'add_nama_project.max' => 'Nama project pada detail maksimal 255 karakter.',

            'add_qty.required' => 'Jumlah project pada detail wajib diisi.',
            'add_qty.integer' => 'Jumlah project pada detail harus berupa angka.',
            'add_qty.min' => 'Jumlah project pada detail minimal 1.',

            'add_satuan.required' => 'Satuan project pada detail wajib diisi.',
            'add_satuan.string' => 'Satuan project pada detail harus berupa teks.',
            'add_satuan.max' => 'Satuan project pada detail maksimal 50 karakter.',

            'add_harga_satuan.required' => 'Harga satuan project wajib diisi.',
            'add_harga_satuan.numeric' => 'Harga satuan project harus berupa angka.',
            'add_harga_satuan.min' => 'Harga satuan project tidak boleh kurang dari 0.',
        ]);
        $data = [
            'sph_id' => $request->add_sph_id,
            'nama_project' => $request->add_nama_project,
            'qty' => $request->add_qty,
            'satuan' => $request->add_satuan,
            'harga_satuan' => $request->add_harga_satuan,
            'jumlah_harga' => $request->add_qty * $request->add_harga_satuan
        ];
        DetailSPH::create($data);
        return response()->json();
    }
    public function edit(string $id)
    {
        $detail = DetailSPH::find($id);
        return response()->json($detail);
    }
    public function update(Request $request, string $id)
    {
        $detail = DetailSPH::find($id);
        $request->validate([
            'edit_nama_project' => 'required|string|max:255',
            'edit_qty' => 'required|integer|min:1',
            'edit_satuan' => 'required|string|max:50',
            'edit_harga_satuan' => 'required|numeric|min:0',
        ], [
            'edit_nama_project.required' => 'Nama project pada detail wajib diisi.',
            'edit_nama_project.string' => 'Nama project pada detail harus berupa teks.',
            'edit_nama_project.max' => 'Nama project pada detail maksimal 255 karakter.',

            'edit_qty.required' => 'Jumlah project pada detail wajib diisi.',
            'edit_qty.integer' => 'Jumlah project pada detail harus berupa angka.',
            'edit_qty.min' => 'Jumlah project pada detail minimal 1.',

            'edit_satuan.required' => 'Satuan project pada detail wajib diisi.',
            'edit_satuan.string' => 'Satuan project pada detail harus berupa teks.',
            'edit_satuan.max' => 'Satuan project pada detail maksimal 50 karakter.',

            'edit_harga_satuan.required' => 'Harga satuan project wajib diisi.',
            'edit_harga_satuan.numeric' => 'Harga satuan project harus berupa angka.',
            'edit_harga_satuan.min' => 'Harga satuan project tidak boleh kurang dari 0.',
        ]);

        $data = [
            'nama_project' => $request->edit_nama_project,
            'qty' => $request->edit_qty,
            'satuan' => $request->edit_satuan,
            'harga_satuan' => $request->edit_harga_satuan,
        ];

        $detail->update($data);
        return response()->json($data);
    }
    public function destroy(string $id)
    {
        $detail = DetailSPH::findOrFail($id);
        $detail->delete();
        return response()->json();
    }
}
