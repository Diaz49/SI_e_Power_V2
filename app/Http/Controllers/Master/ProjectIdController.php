<?php

namespace App\Http\Controllers\Master;

use App\DataTables\Master\DataProjectIdDataTable;
use App\Http\Controllers\Controller;
use App\Models\Projectid;
use Illuminate\Http\Request;


use function Termwind\render;

class ProjectIdController extends Controller
{
    public function index(DataProjectIdDataTable $dataTable)
    {
        return $dataTable->render('master.data-project-id.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|string|unique:project_id,project_id|max:255',
            'nama_project' => 'required|string|max:100',
            'nama_client' => 'required|string|max:100',
            'alamat' => 'required|string',
            'hpp' => 'required|numeric|min:0',
            'rab' => 'required|numeric|min:0',
        ], [
            'hpp.required' => 'HPP harus diisi.',
            'hpp.numeric' => 'HPP harus berupa angka.',
            'hpp.min' => 'HPP tidak boleh kurang dari 0.',
            'rab.required' => 'RAB harus diisi.',
            'rab.numeric' => 'RAB harus berupa angka.',
            'rab.min' => 'RAB tidak boleh kurang dari 0.',
        ]);
        $data = [
            'project_id' => $request->project_id,
            'nama_project' => $request->nama_project,
            'nama_client' => $request->nama_client,
            'alamat' => $request->alamat,
            'hpp' => $request->hpp,
            'rab' => $request->rab,
        ];
        Projectid::create($data);
        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    }

    public function delete(string $id)
    {
        $projectid = Projectid::findOrFail($id);
        $projectid->delete();
        return response()->json([
            'success' => 'Data karyawan berhasil dihapus!'
        ], 200);    }
}
