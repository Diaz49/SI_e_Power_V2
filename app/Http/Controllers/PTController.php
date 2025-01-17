<?php

namespace App\Http\Controllers;

use App\DataTables\PTDataTable;
use App\Http\Controllers\Controller;
use App\Models\PT;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;

class PTController extends Controller
{
    public function index(PTDataTable $dataTable)
    {
        return $dataTable->render('pt.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pt' => 'required|string|max:50',
            'kode_pt' => 'required|string|max:10',
        ], [
            
            'nama_pt.required' => 'Nama PT wajib diisi.',
            'nama_pt.string' => 'Nama PT harus berupa teks.',
            'nama_pt.max' => 'Nama PT tidak boleh lebih dari 50 karakter.',
            'kode_pt.required' => 'Kode PT wajib diisi.',
            'kode_pt.string' => 'Kode PT harus berupa teks.',
            'kode_pt.max' => 'Kode PT tidak boleh lebih dari 10 karakter.',

        ]);
        
        $data = [
            'nama_pt' => $request->nama_pt,
            'kode_pt' => $request->kode_pt,
        ];
        PT::create($data);
        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $pt = PT::find($id);
        return response()->json($pt);
    }

    public function update(Request $request, string $id)
    {
        $pt = PT::findOrFail($id); // tambahkan fail jika id tidak ditemukan
        $request->validate([
            'nama_pt_edit' => 'required|string|max:50',
            'kode_pt_edit' => 'required|string|max:50',
        ], [
            
            'nama_pt_edit.required' => 'Nama PT (edit) wajib diisi.',
            'nama_pt_edit.string' => 'Nama PT (edit) harus berupa teks.',
            'nama_pt_edit.max' => 'Nama PT (edit) tidak boleh lebih dari 50 karakter.',
            'kode_pt_edit.required' => 'Kode PT (edit) wajib diisi.',
            'kode_pt_edit.string' => 'Kode PT (edit) harus berupa teks.',
            'kode_pt_edit.max' => 'Kode PT (edit) tidak boleh lebih dari 50 karakter.'

        ]);

        // Update data dengan input yang sesuai
        $pt->update([
            'nama_pt' => $request->nama_pt_edit,
            'kode_pt' => $request->kode_pt_edit,
        ]);

        return response()->json([
            'success' => 'Data Client berhasil di edit!'
        ], 200);

        // return redirect()->back();
    }

    public function destroy(string $id)
    {
        $pt = PT::findOrFail($id);
        $pt->delete();
        return response()->json([
            'success' => 'Data Bank berhasil dihapus!'
        ], 200);    
    }
}
