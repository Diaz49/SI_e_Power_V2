<?php

namespace App\Http\Controllers\Master;

use App\DataTables\Master\DataProjectIdDataTable;
use App\Http\Controllers\Controller;
use App\Models\Projectid;
use Illuminate\Http\Request;
use App\Models\PT;
use App\Exports\ProjectIdExport;
use Maatwebsite\Excel\Facades\Excel;


use function Termwind\render;

class ProjectIdController extends Controller
{
    public function index(DataProjectIdDataTable $dataTable)
    {   
        $pt = PT::all();
        $years = Projectid::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');
        return $dataTable->render('master.data-project-id.index', compact('pt','years'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pt' => 'required|max:50',
            'project_id' => 'required|string|unique:project_id,project_id|max:50',
            'nama_project' => 'required|string|max:100',
            'nama_client' => 'required|string|max:100',
            'alamat' => 'required|string',
            'hpp' => 'required|numeric|min:0',
            'rab' => 'required|numeric|min:0',
        ], [
            'nama_pt.required' => 'Nama PT wajib diisi.',
            'nama_pt.max' => 'Nama PT tidak boleh lebih dari 50 karakter.',
            
            'project_id.required' => 'ID project harus diisi.',
            'project_id.string' => 'ID project harus berupa teks.',
            'project_id.unique' => 'ID project sudah terdaftar.',
            'project_id.max' => 'ID project tidak boleh lebih dari 50 karakter.',

            'nama_project.required' => 'Nama project harus diisi.',
            'nama_project.string' => 'Nama project harus berupa teks.',
            'nama_project.max' => 'Nama project tidak boleh lebih dari 100 karakter.',

            'nama_client.required' => 'Nama client harus diisi.',
            'nama_client.string' => 'Nama client harus berupa teks.',
            'nama_client.max' => 'Nama client tidak boleh lebih dari 100 karakter.',

            'alamat.required' => 'Alamat harus diisi.',
            'alamat.string' => 'Alamat harus berupa teks.',

            'hpp.required' => 'HPP harus diisi.',
            'hpp.numeric' => 'HPP harus berupa angka.',
            'hpp.min' => 'HPP tidak boleh kurang dari 0.',

            'rab.required' => 'RAB harus diisi.',
            'rab.numeric' => 'RAB harus berupa angka.',
            'rab.min' => 'RAB tidak boleh kurang dari 0.',
        ]);

        $data = [
            'pt_id' => $request->nama_pt,
            'project_id' => $request->project_id,
            'nama_project' => $request->nama_project,
            'nama_client' => $request->nama_client,
            'alamat' => $request->alamat,
            'hpp' => $request->hpp,
            'rab' => $request->rab,
        ];
        Projectid::create($data);
        return response()->json(['success' => 'Data berhasil di tambah!'], 200);
    }

    public function edit(string $id)
    {
        $projectid = Projectid::find($id);
        // dd($projectid);
        return response()->json($projectid);
    }
    public function update(Request $request, string $id)
    {
        $projectid = Projectid::findOrFail($id); // tambahkan fail jika id tidak ditemukan
        $request->validate([
            'nama_pt_edit' => 'required|max:50',
            'project_id_edit' => 'required|string|max:50',
            'nama_project_edit' => 'required|string|max:100',
            'nama_client_edit' => 'required|string|max:100',
            'alamat_edit' => 'required|string',
            'hpp_edit' => 'required|numeric|min:0',
            'rab_edit' => 'required|numeric|min:0',
        ], [
            'nama_pt_edit.required' => 'Nama PT wajib diisi.',
            'nama_pt_edit.max' => 'Nama PT tidak boleh lebih dari 50 karakter.',

            'project_id_edit.required' => 'ID project harus diisi.',
            'project_id_edit.string' => 'ID project harus berupa teks.',
            'project_id_edit.max' => 'ID project tidak boleh lebih dari 50 karakter.',

            'nama_project_edit.required' => 'Nama project harus diisi.',
            'nama_project_edit.string' => 'Nama project harus berupa teks.',
            'nama_project_edit.max' => 'Nama project tidak boleh lebih dari 100 karakter.',

            'nama_client_edit.required' => 'Nama client harus diisi.',
            'nama_client_edit.string' => 'Nama client harus berupa teks.',
            'nama_client_edit.max' => 'Nama client tidak boleh lebih dari 100 karakter.',

            'alamat_edit.required' => 'Alamat harus diisi.',
            'alamat_edit.string' => 'Alamat harus berupa teks.',

            'hpp_edit.required' => 'HPP harus diisi.',
            'hpp_edit.numeric' => 'HPP harus berupa angka.',
            'hpp_edit.min' => 'HPP tidak boleh kurang dari 0.',

            'rab_edit.required' => 'RAB harus diisi.',
            'rab_edit.numeric' => 'RAB harus berupa angka.',
            'rab_edit.min' => 'RAB tidak boleh kurang dari 0.',
        ]);


        // Update data dengan input yang sesuai
        $projectid->update([
            'pt_id' => $request->nama_pt_edit,
            'project_id' => $request->project_id_edit,
            'nama_project' => $request->nama_project_edit,
            'nama_client' => $request->nama_client_edit,
            'alamat' => $request->alamat_edit,
            'hpp' => $request->hpp_edit,
            'rab' => $request->rab_edit,
        ]);

        return response()->json([
            'success' => 'Data project berhasil di edit!'
        ], 200);

        // return redirect()->back();
    }

    public function delete(string $id)
    {
        $projectid = Projectid::findOrFail($id);
        $projectid->delete();
        return response()->json([
            'success' => 'Data project berhasil dihapus!'
        ], 200);
    }

    public function exportToExcel()
    {
        return Excel::download(new ProjectIdExport, 'projectid.xlsx');
    }
}
