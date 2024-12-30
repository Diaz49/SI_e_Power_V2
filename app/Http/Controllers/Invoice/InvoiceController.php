<?php

namespace App\Http\Controllers\Invoice;

use App\DataTables\InvoiceDataTable;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\DataClient;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function index(InvoiceDataTable $dataTable)
    {
        $client = DataClient::all();
        $bank = Bank::all();
        return $dataTable->render('invoice.index', compact('client', 'bank'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'header.kode_invoice' => 'required|max:100|unique:invoice,kd_invoice',
            'header.header_deskripsi' => 'required',
            'header.tanggal' => 'required|date',
            'header.nama_client' => 'required|max:50',
            'header.no_bast_1' => 'required|string',
            'header.no_bast_2' => 'nullable|string',
            'header.no_bast_3' => 'nullable|string',
            'header.no_bast_4' => 'nullable|string',
            'header.no_bast_5' => 'nullable|string',
            'header.jenis_no' => 'required|string',
            'header.due_date' => 'required|string',
            'header.nama_bank' => 'required|string',
            'header.no_1' => 'required|string',
            'header.no_2' => 'nullable|string',
            'header.no_3' => 'nullable|string',
            'header.no_4' => 'nullable|string',
            'header.no_5' => 'nullable|string',
            'details.*.nama_barang' => 'required|string|max:255',
            'details.*.qty' => 'required|integer|min:1',
            'details.*.satuan' => 'required|string|max:50',
            'details.*.harga_satuan' => 'required|numeric|min:0',
        ], [
            'header.kode_invoice.required' => 'Kode invoice wajib diisi.',
            'header.kode_invoice.max' => 'Kode invoice tidak boleh lebih dari 100 karakter.',
            'header.kode_invoice.unique' => 'Kode invoice sudah digunakan.',
            'header.header_deskripsi.required' => 'Deskripsi header wajib diisi.',
            'header.tanggal.required' => 'Tanggal wajib diisi.',
            'header.tanggal.date' => 'Format tanggal tidak valid.',
            'header.nama_client.required' => 'Nama client wajib diisi.',
            'header.nama_client.max' => 'Nama client tidak boleh lebih dari 50 karakter.',
            'header.no_bast_1.required' => 'Nomor BAST 1 wajib diisi.',
            'header.jenis_no.required' => 'Jenis nomor wajib diisi.',
            'header.jenis_no.string' => 'Jenis nomor harus berupa teks.',
            'header.due_date.required' => 'Tanggal jatuh tempo wajib diisi.',
            'header.due_date.string' => 'Tanggal jatuh tempo harus berupa teks.',
            'header.nama_bank.required' => 'Nama bank wajib diisi.',
            'header.nama_bank.string' => 'Nama bank harus berupa teks.',
            'header.no_1.required' => 'Nomor 1 wajib diisi.',

            'details.*.nama_barang.required' => 'Nama barang pada detail wajib diisi.',
            'details.*.nama_barang.string' => 'Nama barang pada detail harus berupa teks.',
            'details.*.nama_barang.max' => 'Nama barang pada detail maksimal 255 karakter.',

            'details.*.qty.required' => 'Jumlah barang pada detail wajib diisi.',
            'details.*.qty.integer' => 'Jumlah barang pada detail harus berupa angka.',
            'details.*.qty.min' => 'Jumlah barang pada detail minimal 1.',

            'details.*.satuan.required' => 'Satuan barang pada detail wajib diisi.',
            'details.*.satuan.string' => 'Satuan barang pada detail harus berupa teks.',
            'details.*.satuan.max' => 'Satuan barang pada detail maksimal 50 karakter.',

            'details.*.harga_satuan.required' => 'Harga satuan barang wajib diisi.',
            'details.*.harga_satuan.numeric' => 'Harga satuan barang harus berupa angka.',
            'details.*.harga_satuan.min' => 'Harga satuan barang tidak boleh kurang dari 0.',
        ]);
        DB::beginTransaction(); // Mulai transaksi
        // Simpan data header

        try {

            $invoice = Invoice::create([
                'kd_invoice' => $request->input('header.kode_invoice'),
                'header_deskripsi' => $request->input('header.header_deskripsi'),
                'tgl_invoice' => $request->input('header.tanggal'),
                'client_id' => $request->input('header.nama_client'),
                'no_bast_1' => $request->input('header.no_bast_1'),
                'no_bast_2' => $request->input('header.no_bast_2'),
                'no_bast_3' => $request->input('header.no_bast_3'),
                'no_bast_4' => $request->input('header.no_bast_4'),
                'no_bast_5' => $request->input('header.no_bast_5'),
                'jenis_no' => $request->input('header.jenis_no'),
                'no_1' => $request->input('header.no_1'),
                'no_2' => $request->input('header.no_2'),
                'no_3' => $request->input('header.no_3'),
                'no_4' => $request->input('header.no_4'),
                'no_5' => $request->input('header.no_5'),
                'due' => $request->input('header.due_date'),
                'bank_id' => $request->input('header.nama_bank'),
            ]);

            // Simpan data detail
            foreach ($request->input('details') as $detail) {
                $jumlah_harga = $detail['qty'] * $detail['harga_satuan'];
                $invoice->detail()->create([
                    'nama_barang' => $detail['nama_barang'],
                    'qty' => $detail['qty'],
                    'satuan' => $detail['satuan'],
                    'harga_satuan' => $detail['harga_satuan'],
                    'jumlah_harga' => $jumlah_harga,
                ]);
            }
            DB::commit();
            return response()->json(['message' => 'Purchase order berhasil disimpan.']);
        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan semua perubahan jika ada error
            return response()->json(['message' => 'Gagal menyimpan purchase order: ' . $e->getMessage()], 500);
        }
    }

    public function edit(string $id)
    {
        $invoice = Invoice::findOrFail($id);
        return  response()->json($invoice, 200);
    }

    public function delete(string $id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();
        return response()->json();
    }
}
