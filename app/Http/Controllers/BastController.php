<?php

namespace App\Http\Controllers;

use App\DataTables\BastDataTable;
use App\Http\Controllers\Controller;
use App\Models\Bast;
use App\Models\PT;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class BastController extends Controller
{

    public function index(BastDataTable $dataTable)
    {
        $invoice = Invoice::all();
        $pt = PT::all();
        return $dataTable->render('bast.index', compact('invoice','pt'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date|max:50',
            'kd_invoice' => 'required|string',
            'nama_pt' => 'required|string',
            'deskripsi' => 'required|string|max:255',
            'nama' => 'required|string|max:50',
            'jabatan' => 'required|string|max:50',
            'jumlah_item' => 'required|numeric|max:10',
            'harga_satuan' => 'required|numeric',
            'total_invoice' => 'required|numeric',
        ], [
            'tanggal.required' => 'Tanggal wajib diisi.',
            'tanggal.date' => 'Tanggal harus berupa format tanggal yang valid.',
            'tanggal.max' => 'Tanggal tidak boleh lebih dari 50 karakter.',
            'kd_invoice.required' => 'Kode invoice wajib diisi.',
            'kd_invoice.string' => 'Kode invoice harus berupa teks.',
            'nama_pt.required' => 'Nama PT wajib diisi.',
            'nama_pt.String' => 'Nama PT harus berupa teks.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'deskripsi.string' => 'Deskripsi harus berupa teks.',
            'deskripsi.max' => 'Deskripsi tidak boleh lebih dari 255 karakter.',
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama tidak boleh lebih dari 50 karakter.',
            'jabatan.required' => 'Jabatan wajib diisi.',
            'jabatan.string' => 'Jabatan harus berupa teks.',
            'jabatan.max' => 'Jabatan tidak boleh lebih dari 50 karakter.',
            'jumlah_item.required' => 'Jumlah item wajib diisi.',
            'jumlah_item.string' => 'Jumlah item harus berupa angka.',
            'jumlah_item.max' => 'Jumlah item tidak boleh lebih dari 10 karakter.',
            'harga_satuan.required' => 'Harga satuan wajib diisi.',
            'harga_satuan.numeric' => 'Harga satuan harus berupa angka.',
            'total_invoice.required' => 'Total invoice wajib diisi.',
            'total_invoice.numeric' => 'Total invoice harus berupa angka.',
        ]);

        $data = [
            'nama' => $request->nama,
            'invoice_id' => $request->kd_invoice, 
            'pt_id' => $request->nama_pt, // Save invoice code
            'tanggal' => $request->tanggal,  // Save invoice date
            'deskripsi' => $request->deskripsi,  // Save description
            'jabatan' => $request->jabatan,  // Save job title
            'jumlah_item' => $request->jumlah_item,  // Save item quantity
            'harga_satuan' => $request->harga_satuan,  // Save unit price
            'total_invoice' => $request->total_invoice,  // Save total invoice amount
        ];

        Bast::create($data);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    }


    public function edit(string $id)
    {
        $bast = Bast::find($id);
        // dd($projectid);
        return response()->json($bast);
    }

    public function update(Request $request, string $id)
    {
        $bast = Bast::findOrFail($id);

        $request->validate([
            'tanggal_edit' => 'required|date|max:50',
            'kd_invoice_edit' => 'required|string',
            'nama_pt_edit' => 'required|string',
            'deskripsi_edit' => 'required|string|max:255',
            'nama_edit' => 'required|string|max:50',
            'jabatan_edit' => 'required|string|max:50',
            'jumlah_item_edit' => 'required|numeric|max:10',
            'harga_satuan_edit' => 'required|numeric',
            'total_invoice_edit' => 'required|numeric' . ($request->jumlah_item_edit * $request->harga_satuan_edit),
        ], [
            'tanggal_edit.required' => 'Tanggal wajib diisi.',
            'tanggal_edit.date' => 'Tanggal harus berupa format tanggal yang valid.',
            'tanggal_edit.max' => 'Tanggal tidak boleh lebih dari 50 karakter.',
            'kd_invoice_edit.required' => 'Kode invoice wajib diisi.',
            'kd_invoice_edit.string' => 'Kode invoice harus berupa teks.',
            'nama_pt_edit.required' => 'Nama PT wajib diisi.',
            'nama_pt_edit.String' => 'Nama PT harus berupa teks.',
            'deskripsi_edit.required' => 'Deskripsi wajib diisi.',
            'deskripsi_edit.string' => 'Deskripsi harus berupa teks.',
            'deskripsi_edit.max' => 'Deskripsi tidak boleh lebih dari 255 karakter.',
            'nama_edit.required' => 'Nama wajib diisi.',
            'nama_edit.string' => 'Nama harus berupa teks.',
            'nama_edit.max' => 'Nama tidak boleh lebih dari 50 karakter.',
            'jabatan_edit.required' => 'Jabatan wajib diisi.',
            'jabatan_edit.string' => 'Jabatan harus berupa teks.',
            'jabatan_edit.max' => 'Jabatan tidak boleh lebih dari 50 karakter.',
            'jumlah_item_edit.required' => 'Jumlah item wajib diisi.',
            'jumlah_item_edit.string' => 'Jumlah item harus berupa angka.',
            'jumlah_item_edit.max' => 'Jumlah item tidak boleh lebih dari 10 karakter.',
            'harga_satuan_edit.required' => 'Harga satuan wajib diisi.',
            'harga_satuan_edit.numeric' => 'Harga satuan harus berupa angka.',
            'total_invoice_edit.required' => 'Total invoice wajib diisi.',
            'total_invoice_edit.numeric' => 'Total invoice harus berupa angka.',
        ]);

        $bast->update([
            'nama' => $request->nama_edit,
            'invoice_id' => $request->kd_invoice_edit,
            'pt_id' => $request->nama_pt_edit,  // Save invoice code
            'tanggal' => $request->tanggal_edit,  // Save invoice date
            'deskripsi' => $request->deskripsi_edit,  // Save description
            'jabatan' => $request->jabatan_edit,
            'jumlah_item' => $request->jumlah_item_edit,
            'harga_satuan' => $request->harga_satuan_edit,
            'total_invoice' => $request->total_invoice_edit,
        ]);

        return response()->json([
            'success' => 'Data berhasil di edit!'
        ], 200);
    }


    public function destroy(string $id)
    {
        $bast = Bast::findOrFail($id);
        $bast->delete();
        return response()->json([
            'success' => 'Data Bank berhasil dihapus!'
        ], 200);    
    }
}
