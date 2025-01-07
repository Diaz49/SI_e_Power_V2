<?php

namespace App\Http\Controllers;

use App\DataTables\BastDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BastController extends Controller
{

    public function index(BastDataTable $dataTable)
    {
        return $dataTable->render('bast.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:50',
            'nama_rek' => 'required|string|max:50',
            'nomer_rek' => 'required|string|max:50',
        ], [
            
            'nama.required' => 'Nama bank wajib diisi.',
            'nama.string' => 'Nama bank harus berupa teks.',
            'nama.max' => 'Nama bank tidak boleh lebih dari 50 karakter.',
            'nama_rek.required' => 'Nama rekening wajib diisi.',
            'nama_rek.string' => 'Nama rekening harus berupa teks.',
            'nama_rek.max' => 'Nama rekening tidak boleh lebih dari 50 karakter.',
            'nomer_rek.required' => 'Nomor rekening wajib diisi.',
            'nomer_rek.string' => 'Nomor rekening harus berupa teks.',
            'nomer_rek.max' => 'Nomor rekening tidak boleh lebih dari 50 karakter.',

        ]);
        
        $data = [
            'nama' => $request->nama,
            'nama_rek' => $request->nama_rek,
            'nomer_rek' => $request->nomer_rek,
        ];
        Bank::create($data);
        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $bank = Bank::find($id);
        // dd($projectid);
        return response()->json($bank);
    }

    public function update(Request $request, string $id)
    {
        $bank = Bank::findOrFail($id); // tambahkan fail jika id tidak ditemukan
        $request->validate([
            'nama_edit' => 'required|string|max:50',
            'nama_rek_edit' => 'required|string|max:50',
            'nomer_rek_edit' => 'required|string|max:50',
            'status_edit' => ['required', Rule::in(['use', 'no_use'])]
        ], [
            
            'nama_edit.required' => 'Nama bank (edit) wajib diisi.',
            'nama_edit.string' => 'Nama bank (edit) harus berupa teks.',
            'nama_edit.max' => 'Nama bank (edit) tidak boleh lebih dari 50 karakter.',
            'nama_rek_edit.required' => 'Nama rekening (edit) wajib diisi.',
            'nama_rek_edit.string' => 'Nama rekening (edit) harus berupa teks.',
            'nama_rek_edit.max' => 'Nama rekening (edit) tidak boleh lebih dari 50 karakter.',
            'nomer_rek_edit.required' => 'Nomor rekening (edit) wajib diisi.',
            'nomer_rek_edit.string' => 'Nomor rekening (edit) harus berupa teks.',
            'nomer_rek_edit.max' => 'Nomor rekening (edit) tidak boleh lebih dari 50 karakter.',
            'status_edit.required' => 'Status (edit) wajib diisi.',
            'status_edit.in' => 'Status (edit) harus bernilai "use" atau "no_use".',

        ]);

        // Update data dengan input yang sesuai
        $bank->update([
            'nama' => $request->nama_edit,
            'nama_rek' => $request->nama_rek_edit,
            'nomer_rek' => $request->nomer_rek_edit,
            'status' => $request->status_edit,
        ]);

        return response()->json([
            'success' => 'Data Client berhasil di edit!'
        ], 200);

        // return redirect()->back();
    }

    public function destroy(string $id)
    {
        $bank = Bank::findOrFail($id);
        $bank->delete();
        return response()->json([
            'success' => 'Data Bank berhasil dihapus!'
        ], 200);    
    }
}
