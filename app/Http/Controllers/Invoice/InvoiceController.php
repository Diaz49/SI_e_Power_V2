<?php

namespace App\Http\Controllers\Invoice;

use App\DataTables\InvoiceDataTable;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\DataClient;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

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
            'header.due_date' => 'required|date',
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
            'header.due_date.date' => 'Tanggal jatuh tempo harus berupa tanggal yang valid.',
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

    public function update(Request $request, string $id)
    {
        $invoice = Invoice::findOrFail($id);
        $request->validate([
            'edit_kode_invoice' => ['required', 'max:100', Rule::unique('invoice', 'kd_invoice')->ignore($invoice->id)],
            'edit_header_deskripsi' => 'required',
            'edit_tanggal' => 'required|date',
            'edit_nama_client' => 'required|max:50',
            'edit_no_bast_1' => 'required|string',
            'edit_no_bast_2' => 'nullable|string',
            'edit_no_bast_3' => 'nullable|string',
            'edit_no_bast_4' => 'nullable|string',
            'edit_no_bast_5' => 'nullable|string',
            'edit_jenis_no' => 'required|string',
            'edit_due_date' => 'required|date',
            'edit_nama_bank' => 'required|string',
            'edit_no_1' => 'required|string',
            'edit_no_2' => 'nullable|string',
            'edit_no_3' => 'nullable|string',
            'edit_no_4' => 'nullable|string',
            'edit_no_5' => 'nullable|string',
            'edit_kode_admin' => 'nullable|string',
            'edit_status' => 'nullable|string',
            'edit_paid' => 'required_if:edit_status,paid|date',
            'edit_no_fp' => 'nullable|string',
        ], [
            'edit_kode_invoice.required' => 'Kode invoice wajib diisi.',
            'edit_kode_invoice.max' => 'Kode invoice tidak boleh lebih dari 100 karakter.',
            'edit_kode_invoice.unique' => 'Kode invoice sudah digunakan.',
            'edit_header_deskripsi.required' => 'Deskripsi header wajib diisi.',
            'edit_tanggal.required' => 'Tanggal wajib diisi.',
            'edit_tanggal.date' => 'Format tanggal tidak valid.',
            'edit_nama_client.required' => 'Nama client wajib diisi.',
            'edit_nama_client.max' => 'Nama client tidak boleh lebih dari 50 karakter.',
            'edit_no_bast_1.required' => 'Nomor BAST 1 wajib diisi.',
            'edit_jenis_no.required' => 'Jenis nomor wajib diisi.',
            'edit_jenis_no.string' => 'Jenis nomor harus berupa teks.',
            'edit_due_date.required' => 'Tanggal jatuh tempo wajib diisi.',
            'edit_due_date.date' => 'Tanggal jatuh tempo harus berupa tanggal yang valid.',
            'edit_nama_bank.required' => 'Nama bank wajib diisi.',
            'edit_nama_bank.string' => 'Nama bank harus berupa teks.',
            'edit_no_1.required' => 'Nomor 1 wajib diisi.',
            'edit_kode_admin.string' => 'Kode admin harus berupa teks.',
            'edit_status.string' => 'Status harus berupa teks.',
            'edit_paid.date' => 'Kolom Paid harus berupa tanggal yang valid.',
            'edit_paid.required_if' => 'Tanggal paid harus di isi.',
            'edit_no_fp.string' => 'Nomor Faktur Pajak harus berupa teks.',
        ]);
        $data = [
            'kd_invoice' => $request->edit_kode_invoice,
            'header_deskripsi' => $request->edit_header_deskripsi,
            'tgl_invoice' => $request->edit_tanggal,
            'client_id' => $request->edit_nama_client,
            'no_bast_1' => $request->edit_no_bast_1,
            'no_bast_2' => $request->edit_no_bast_2,
            'no_bast_3' => $request->edit_no_bast_3,
            'no_bast_4' => $request->edit_no_bast_4,
            'no_bast_5' => $request->edit_no_bast_5,
            'jenis_no' => $request->edit_jenis_no,
            'no_1' => $request->edit_no_1,
            'no_2' => $request->edit_no_2,
            'no_3' => $request->edit_no_3,
            'no_4' => $request->edit_no_4,
            'no_5' => $request->edit_no_5,
            'due' => $request->edit_due_date,
            'bank_id' => $request->edit_nama_bank,
            'status' => $request->edit_status,
            'no_fp' => $request->edit_no_fp,
            'kd_admin' => $request->edit_kode_admin,
        ];
        if ($request->edit_status === 'paid') {
            $data['tgl_paid'] = $request->edit_paid;
        } else {
            $data['tgl_paid'] = null;
        }
        $invoice->update($data);

        return response()->json();
    }

    public function delete(string $id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();
        return response()->json();
    }
}