<?php

namespace App\Http\Controllers\Master;

use App\DataTables\Master\BankDataTable;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BankDataTable $dataTable)
    {
        return $dataTable->render('master.data-bank.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_bank' => 'required|string|max:50',
            'nama_rek' => 'required|string|max:50',
            'nomer_rek' => 'required|string|max:50',
        ], [
            
        ]);
        
        $data = [
            'nama_bank' => $request->nama_bank,
            'nama_rek' => $request->nama_rek,
            'nomer_rek' => $request->nomer_rek,
        ];
        Bank::create($data);
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
        $bank = Bank::find($id);
        // dd($projectid);
        return response()->json($bank);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bank = Bank::findOrFail($id); // tambahkan fail jika id tidak ditemukan
        $request->validate([
            'nama_bank_edit' => 'required|string|max:50',
            'nama_rek_edit' => 'required|string|max:50',
            'nomer_rek_edit' => 'required|string|max:50',
            'status_edit' => ['required', Rule::in(['use', 'not_use'])]
        ], [
            
        ]);

        // Update data dengan input yang sesuai
        $bank->update([
            'nama_bank' => $request->nama_bank_edit,
            'nama_rek' => $request->nama_rek_edit,
            'nomer_rek' => $request->nomer_rek_edit,
            'status' => $request->status_edit,
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
        $bank = Bank::findOrFail($id);
        $bank->delete();
        return response()->json([
            'success' => 'Data Bank berhasil dihapus!'
        ], 200);    
    }
}
