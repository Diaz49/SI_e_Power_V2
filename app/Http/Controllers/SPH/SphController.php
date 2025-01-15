<?php

namespace App\Http\Controllers\SPH;

use App\DataTables\SphDataTable;
use App\Http\Controllers\Controller;
use App\Models\Sph;
use App\Models\DataClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class SphController extends Controller
{

    public function index(SphDataTable $dataTable)
    {
        $dataclient = DataClient::all();
        return $dataTable->render('sph.index', compact('dataclient'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'header.kode_sph' => 'required|max:100|unique:po,kode_po',
            'header.tanggal' => 'required|date',
            'header.nama_client' => 'required',
            'header.penawaran_harga' => 'required|string|',
            'details.*.nama_project' => 'required|string|max:255',
            'details.*.qty' => 'required|integer|min:1',
            'details.*.satuan' => 'required|string|max:50',
            'details.*.harga_satuan' => 'required|numeric|min:0',
        ], [
            'header.kode_sph.required' => 'Kode SPH wajib diisi.',
            'header.kode_sph.max' => 'Kode SPH maksimal 100 karakter.',
            'header.kode_sph.unique' => 'Kode SPH sudah terdaftar.',

            'header.tanggal.required' => 'Tanggal wajib diisi.',
            'header.tanggal.date' => 'Tanggal harus dalam format yang valid.',

            'header.nama_client.required' => 'Nama vendor wajib diisi.',

            'header.penawaran_harga.required' => 'Perihal penawaran harga harus di isi.',
            'header.penawaran_harga.string' => 'Perihal penawaran harga harus berupa string.',

            'details.*.nama_project.required' => 'Nama project pada detail wajib diisi.',
            'details.*.nama_project.string' => 'Nama project pada detail harus berupa teks.',
            'details.*.nama_project.max' => 'Nama project pada detail maksimal 255 karakter.',

            'details.*.qty.required' => 'Jumlah project pada detail wajib diisi.',
            'details.*.qty.integer' => 'Jumlah project pada detail harus berupa angka.',
            'details.*.qty.min' => 'Jumlah project pada detail minimal 1.',

            'details.*.satuan.required' => 'Satuan project pada detail wajib diisi.',
            'details.*.satuan.string' => 'Satuan project pada detail harus berupa teks.',
            'details.*.satuan.max' => 'Satuan project pada detail maksimal 50 karakter.',

            'details.*.harga_satuan.required' => 'Harga satuan project wajib diisi.',
            'details.*.harga_satuan.numeric' => 'Harga satuan project harus berupa angka.',
            'details.*.harga_satuan.min' => 'Harga satuan project tidak boleh kurang dari 0.',
        ]);
        DB::beginTransaction(); // Mulai transaksi
        // Simpan data header

        try {

            $sph = Sph::create([
                'kode_sph' => $request->input('header.kode_sph'),
                'tanggal' => $request->input('header.tanggal'),
                'data_client_id' => $request->input('header.nama_client'),
                'penawaran_harga' => $request->input('header.penawaran_harga'),
            ]);

            // Simpan data detail
            foreach ($request->input('details') as $detail) {
                $jumlah_harga = $detail['qty'] * $detail['harga_satuan'];
                $sph->detailSph()->create([
                    'nama_project' => $detail['nama_project'],
                    'qty' => $detail['qty'],
                    'satuan' => $detail['satuan'],
                    'harga_satuan' => $detail['harga_satuan'],
                    'jumlah_harga' => $jumlah_harga,
                ]);
            }
            DB::commit();
            return response()->json(['message' => 'Sph berhasil disimpan.']);
        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan semua perubahan jika ada error
            return response()->json(['message' => 'Gagal menyimpan sph: ' . $e->getMessage()], 500);
        }
    }

    public function edit(string $id)
    {
        $sph = Sph::find($id);
        return response()->json($sph, 200);
    }

    public function update(Request $request, string $id)
    {
        $sph = Sph::findOrFail($id);
        $request->validate([
            'edit_kode_sph' => ['required', 'max:100',   Rule::unique('sph', 'kode_sph')->ignore($sph->id)],
            'edit_tanggal' => 'required|date',
            'edit_nama_client' => 'required',
            'edit_kode_admin' => 'nullable',
            'edit_penawaran_harga' => 'required|string',
        ], [
            'edit_kode_sph.required' => 'Kode Surat Penawaran Harga wajib diisi.',
            'edit_kode_sph.max' => 'Kode Surat Penawaran Harga maksimal 100 karakter.',
            'edit_kode_sph.unique' => 'Kode Surat Penawaran Harga sudah terdaftar.',

            'edit_tanggal.required' => 'Tanggal wajib diisi.',
            'edit_tanggal.date' => 'Tanggal harus dalam format yang valid.',

            'edit_nama_client.required' => 'Nama vendor wajib diisi.',

            'edit_penawaran_harga.required' => 'Perihal penawaran harga harus di isi.',
            'edit_penawaran_harga.string' => 'Perihal penawaran harga harus berupa huruf.',
            

        ]);

        $sph->update([
            'kode_sph' => $request->edit_kode_sph,
            'tanggal' => $request->edit_tanggal,
            'data_client_id' => $request->edit_nama_client,
            'penawaran_harga' => $request->edit_penawaran_harga,
            'kd_admin' => $request->edit_kode_admin,
        ]);
        return response()->json(['success' => 'Data header berhasil di edit!'], 200);
    }

    public function destroy(string $id)
    {
        $sph = Sph::find($id);
        $sph->delete();
        return response()->json();
    }
}
