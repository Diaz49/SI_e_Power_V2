<?php

namespace App\Http\Controllers\Master;

use App\DataTables\Master\DataClientDataTable;
use App\Http\Controllers\Controller;
use App\Models\DataClient;
use Illuminate\Http\Request;

use function Termwind\render;

class DataClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(DataClientDataTable $dataTable)
    {
        return $dataTable->render('master.data-client.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_client' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'up_invoice' => 'required|numeric|min:0',
            'up_sph' => 'required|numeric|min:0',
        ], [
            'up_invoice.required' => 'HPP harus diisi.',
            'up_invoice.numeric' => 'HPP harus berupa angka.',
            'up_invoice.min' => 'HPP tidak boleh kurang dari 0.',
            'up_sph.required' => 'RAB harus diisi.',
            'up_sph.numeric' => 'RAB harus berupa angka.',
            'up_sph.min' => 'RAB tidak boleh kurang dari 0.',
        ]);
        $data = [
            'nama_client' => $request->nama_client,
            'alamat' => $request->alamat,
            'up_invoice' => $request->up_invoice,
            'up_sph' => $request->up_sph,
        ];
        DataClient::create($data);
        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dataclient = DataClient::find($id);
        // dd($projectid);
        return response()->json($dataclient);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataclient = DataClient::findOrFail($id); // tambahkan fail jika id tidak ditemukan
        $request->validate([
            'nama_client_edit' => 'required|string|max:100',
            'alamat_edit' => 'required|string|max:255',
            'up_invoice_edit' => 'required|numeric|min:0',
            'up_sph_edit' => 'required|numeric|min:0',
        ], [
            'alamat_edit.required' => 'Alamat harus diisi.',
            'alamat_edit.string' => 'Alamat harus berupa teks.',

            'up_invoice_edit.required' => 'HPP harus diisi.',
            'up_invoice_edit.numeric' => 'HPP harus berupa angka.',
            'up_invoice_edit.min' => 'HPP tidak boleh kurang dari 0.',

            'up_sph_edit.required' => 'RAB harus diisi.',
            'up_sph_edit.numeric' => 'RAB harus berupa angka.',
            'up_sph_edit.min' => 'RAB tidak boleh kurang dari 0.',
        ]);

        // Update data dengan input yang sesuai
        $dataclient->update([
            'nama_client' => $request->nama_client_edit,
            'alamat' => $request->alamat_edit,
            'up_invoice' => $request->up_invoice_edit,
            'up_sph' => $request->up_sph_edit,
        ]);

        return response()->json([
            'success' => 'Data Client berhasil di edit!'
        ], 200);

        // return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dataclient = DataClient::findOrFail($id);
        $dataclient->delete();
        return response()->json([
            'success' => 'Data karyawan berhasil dihapus!'
        ], 200);    
    }
}
