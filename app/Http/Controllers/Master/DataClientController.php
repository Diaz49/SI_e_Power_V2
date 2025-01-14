<?php

namespace App\Http\Controllers\Master;

use App\DataTables\Master\DataClientDataTable;
use App\Http\Controllers\Controller;
use App\Models\DataClient;
use App\Models\PT;
use Illuminate\Http\Request;
use App\Exports\DataClientExport;
use Maatwebsite\Excel\Facades\Excel;

use function Termwind\render;

class DataClientController extends Controller
{
    public function index(DataClientDataTable $dataTable)
    {
        $pt = PT::all();
        $years = DataClient::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');
        return $dataTable->render('master.data-client.index', compact('pt','years'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pt' => 'required|max:50',
            'nama_client' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'no_tlp' => 'required|numeric|digits_between:10,14',
            'up_invoice' => 'required|string|min:0',
            'up_sph' => 'required|numeric|min:0',
        ], [
            'nama_pt.required' => 'Nama PT wajib diisi.',
            'nama_pt.max' => 'Nama PT tidak boleh lebih dari 50 karakter.',
            'nama_client.required' => 'Nama Client harus diisi.',
            'nama_client.string' => 'Nama Client harus berupa teks.',
            'alamat.required' => 'Alamat harus diisi.',
            'alamat.string' => 'Alamat harus berupa teks.',
            'no_tlp.required' => 'Nomor telepon wajib diisi.',
            'no_tlp.numeric' => 'Nomor telepon harus berupa angka.',
            'no_tlp.digits_between' => 'Nomor telepon harus memiliki panjang antara 10 hingga 14 digit.',
            'up_invoice.required' => 'Up Invoice harus diisi.',
            'up_invoice.string' => 'Up Invoice harus berupa teks.',
            'up_invoice.min' => 'Up Invoice tidak boleh kurang dari 0.',
            'up_sph.required' => 'Up Sph harus diisi.',
            'up_sph.numeric' => 'Up Sph harus berupa angka.',
            'up_sph.min' => 'Up sph tidak boleh kurang dari 0.',
        ]);
        $data = [
            'pt_id' => $request->nama_pt,
            'nama_client' => $request->nama_client,
            'alamat' => $request->alamat,
            'no_tlp' => $request->no_tlp,
            'up_invoice' => $request->up_invoice,
            'up_sph' => $request->up_sph,
        ];
        DataClient::create($data);
        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $dataclient = DataClient::find($id);
        // dd($projectid);
        return response()->json($dataclient);
    }

    public function update(Request $request, string $id)
    {
        $dataclient = DataClient::findOrFail($id); // tambahkan fail jika id tidak ditemukan
        $request->validate([
            'nama_pt_edit' => 'required|max:50',
            'nama_client_edit' => 'required|string|max:100',
            'alamat_edit' => 'required|string|max:255',
            'no_tlp_edit' => 'required|numeric|digits_between:10,14',
            'up_invoice_edit' => 'required|string|min:0',
            'up_sph_edit' => 'required|numeric|min:0',
        ], [
            'nama_pt_edit.required' => 'Nama PT wajib diisi.',
            'nama_pt_edit.max' => 'Nama PT tidak boleh lebih dari 50 karakter.',
            
            'nama_client_edit.required' => 'Nama Client harus diisi.',
            'nama_client_edit.string' => 'Nama Client harus berupa teks.',

            'alamat_edit.required' => 'Alamat harus diisi.',
            'alamat_edit.string' => 'Alamat harus berupa teks.',

            'no_tlp_edit.required' => 'Nomor telepon wajib diisi.',
            'no_tlp_edit.numeric' => 'Nomor telepon harus berupa angka.',
            'no_tlp_edit.digits_between' => 'Nomor telepon harus memiliki panjang antara 10 hingga 14 digit.',

            'up_invoice_edit.required' => 'Up Invoice harus diisi.',
            'up_invoice_edit.string' => 'Up Invoice harus berupa teks.',
            'up_invoice_edit.min' => 'Up Invoice tidak boleh kurang dari 0.',

            'up_sph_edit.required' => 'Up Sph harus diisi.',
            'up_sph_edit.numeric' => 'Up Sph harus berupa angka.',
            'up_sph_edit.min' => 'Up Sph tidak boleh kurang dari 0.',
        ]);

        // Update data dengan input yang sesuai
        $dataclient->update([
            'pt_id' => $request->nama_pt_edit,
            'nama_client' => $request->nama_client_edit,
            'alamat' => $request->alamat_edit,
            'no_tlp' => $request->no_tlp_edit,
            'up_invoice' => $request->up_invoice_edit,
            'up_sph' => $request->up_sph_edit,
        ]);

        return response()->json([
            'success' => 'Data Client berhasil di edit!'
        ], 200);

        // return redirect()->back();
    }

    public function destroy(string $id)
    {
        $dataclient = DataClient::findOrFail($id);
        $dataclient->delete();
        return response()->json([
            'success' => 'Data karyawan berhasil dihapus!'
        ], 200);    
    }

    public function exportToExcel()
    {
        return Excel::download(new DataClientExport, 'dataclients.xlsx');
    }
}
