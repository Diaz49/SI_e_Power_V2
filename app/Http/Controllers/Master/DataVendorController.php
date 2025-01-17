<?php

namespace App\Http\Controllers\Master;

use App\DataTables\Master\DataVendorDataTable;
use App\Http\Controllers\Controller;
use App\Models\DataVendor;
use Illuminate\Http\Request;
use App\Models\PT;
use App\Exports\VendorExport;
use Maatwebsite\Excel\Facades\Excel;

class DataVendorController extends Controller
{
    public function index(DataVendorDataTable $dataTable)
    {
        $pt = PT::all();
        $years = DataVendor::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');
        return $dataTable->render('master.data-vendor.index', compact('pt','years'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pt' => 'required|max:50',
            'nama_vendor' => 'required|string|max:50',
            'alamat_vendor' => 'required|string',
            'kota' => 'required|string|max:40',
            'no_tlp' => 'required|numeric',
            'email' => 'required|email',
            'up' => 'required|string',
        ], [
            'nama_pt.required' => 'Nama PT wajib diisi.',
            'nama_pt.max' => 'Nama PT tidak boleh lebih dari 50 karakter.',
            'nama_vendor.required' => 'Nama vendor wajib diisi.',
            'nama_vendor.string' => 'Nama vendor harus berupa teks.',
            'nama_vendor.max' => 'Nama vendor tidak boleh lebih dari 50 karakter.',
            'alamat_vendor.required' => 'Alamat vendor wajib diisi.',
            'alamat_vendor.string' => 'Alamat vendor harus berupa teks.',
            'kota.required' => 'Kota wajib diisi.',
            'kota.string' => 'Kota harus berupa teks.',
            'kota.max' => 'Nama kota tidak boleh lebih dari 40 karakter.',
            'no_tlp.required' => 'Nomor telepon wajib diisi.',
            'no_tlp.numeric' => 'Nomor telepon harus berupa angka.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'up.required' => 'Nama UP wajib diisi.',
            'up.string' => 'Nama UP harus berupa teks.',
        ]);

        $data = [
            'pt_id' => $request->nama_pt,
            'nama_vendor'  => $request->nama_vendor,
            'alamat_vendor'  => $request->alamat_vendor,
            'kota'  => $request->kota,
            'no_tlp'  => $request->no_tlp,
            'email'  => $request->email,
            'up'  => $request->up,
        ];
        DataVendor::create($data);
        return response()->json(['success' => 'Data berhasil di tambah!'], 200);
    }

    public function edit(string $id)
    {
        $vendor= DataVendor::find($id);
        // dd($projectid);
        return response()->json($vendor);
    }
    public function update(Request $request, string $id)
    {
        $vendor = DataVendor::findOrFail($id); // tambahkan fail jika id tidak ditemukan
        $request->validate([
            'nama_pt_edit' => 'required|max:50',
            'nama_vendor_edit' => 'required|string|max:50',
            'alamat_vendor_edit' => 'required|string',
            'kota_edit' => 'required|string|max:40',
            'no_tlp_edit' => 'required|numeric',
            'email_edit' => 'required|email',
            'up_edit' => 'required|string',
        ], [
            'nama_pt_edit.required' => 'Nama PT wajib diisi.',
            'nama_pt_edit.max' => 'Nama PT tidak boleh lebih dari 50 karakter.',
            'nama_vendor_edit.required' => 'Nama vendor wajib diisi.',
            'nama_vendor_edit.string' => 'Nama vendor harus berupa teks.',
            'nama_vendor_edit.max' => 'Nama vendor tidak boleh lebih dari 50 karakter.',
            'alamat_vendor_edit.required' => 'Alamat vendor wajib diisi.',
            'alamat_vendor_edit.string' => 'Alamat vendor harus berupa teks.',
            'kota_edit.required' => 'Kota wajib diisi.',
            'kota_edit.string' => 'Kota harus berupa teks.',
            'kota_edit.max' => 'Nama kota tidak boleh lebih dari 40 karakter.',
            'no_tlp_edit.required' => 'Nomor telepon wajib diisi.',
            'no_tlp_edit.numeric' => 'Nomor telepon harus berupa angka.',
            'email_edit.required' => 'Email wajib diisi.',
            'email_edit.email' => 'Format email tidak valid.',
            'up_edit.required' => 'Nama UP wajib diisi.',
            'up_edit.string' => 'Nama UP harus berupa teks.',
        ]);


        // Update data dengan input yang sesuai
        $vendor->update([
            'pt_id' => $request->nama_pt_edit,
            'nama_vendor'  => $request->nama_vendor_edit,
            'alamat_vendor'  => $request->alamat_vendor_edit,
            'kota'  => $request->kota_edit,
            'no_tlp'  => $request->no_tlp_edit,
            'email'  => $request->email_edit,
            'up'  => $request->up_edit,
        ]);

        return response()->json([
            'success' => 'Data Vendor berhasil di edit!'
        ], 200);

        // return redirect()->back();
    }


    public function delete(string $id)
    {
        $vendor = DataVendor::findOrFail($id);
        $vendor->delete();
        return response()->json([
            'success' => 'Data vendor berhasil dihapus!'
        ], 200);
    }
    
    public function exportToExcel()
    {
        return Excel::download(new VendorExport, 'data vendor.xlsx');
    }
}
