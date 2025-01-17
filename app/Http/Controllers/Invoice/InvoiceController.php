<?php

namespace App\Http\Controllers\Invoice;

use App\DataTables\InvoiceDataTable;
use App\Exports\InvoiceExport;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\DataClient;
use App\Models\Invoice;
use App\Models\PT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class InvoiceController extends Controller
{
    public function index(InvoiceDataTable $dataTable)
    {
        $client = DataClient::all();
        $pt = PT::all();
        $bank = Bank::all();
        $years = Invoice::selectRaw('YEAR(tgl_invoice) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year'); // Mengambil nilai tahun unik
        return $dataTable->render('invoice.index', compact('client', 'bank', 'pt', 'years'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'header.kode_invoice' => [
                'required',
                Rule::unique('invoice', 'kd_invoice')
                    ->where('pt_id', $request->input('header.nama_pt')), // Pastikan mengganti 'pt_id' sesuai nama kolom PT di tabel
            ],
            'header.header_deskripsi' => 'required',
            'header.tanggal' => 'required|date',
            'header.nama_client' => 'required|max:50',
            'header.nama_pt' => 'required|max:50',
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
            'details.*.harga_satuan' => 'required|numeric',
        ], [
            'header.kode_invoice.required' => 'Kode invoice harus diisi.',
            'header.kode_invoice.max' => 'Kode invoice maksimal 100 karakter.',
            'header.kode_invoice.numeric' => 'Kode invoice harus berupa angka.',
            'header.kode_invoice.unique' => 'Kode invoice sudah digunakan untuk PT ini.',
            'header.header_deskripsi.required' => 'Deskripsi header harus diisi.',
            'header.tanggal.required' => 'Tanggal harus diisi.',
            'header.tanggal.date' => 'Tanggal harus berupa format tanggal yang valid.',
            'header.nama_client.required' => 'Nama client harus diisi.',
            'header.nama_client.max' => 'Nama client maksimal 50 karakter.',
            'header.nama_pt.required' => 'Nama PT harus diisi.',
            'header.nama_pt.max' => 'Nama PT maksimal 50 karakter.',
            'header.no_bast_1.required' => 'Nomor BAST 1 harus diisi.',
            'header.jenis_no.required' => 'Jenis nomor harus diisi.',
            'header.due_date.required' => 'Tanggal jatuh tempo harus diisi.',
            'header.due_date.date' => 'Tanggal jatuh tempo harus berupa format tanggal yang valid.',
            'header.nama_bank.required' => 'Nama bank harus diisi.',
            'header.no_1.required' => 'Nomor 1 harus diisi.',
            'details.*.nama_barang.required' => 'Nama barang harus diisi.',
            'details.*.nama_barang.string' => 'Nama barang harus berupa teks.',
            'details.*.nama_barang.max' => 'Nama barang maksimal 255 karakter.',
            'details.*.qty.required' => 'Kuantitas barang harus diisi.',
            'details.*.qty.integer' => 'Kuantitas barang harus berupa angka.',
            'details.*.qty.min' => 'Kuantitas barang minimal 1.',
            'details.*.satuan.required' => 'Satuan barang harus diisi.',
            'details.*.satuan.max' => 'Satuan barang maksimal 50 karakter.',
            'details.*.harga_satuan.required' => 'Harga satuan harus diisi.',
            'details.*.harga_satuan.numeric' => 'Harga satuan harus berupa angka.',
        ]);
        DB::beginTransaction();


        try {
            // Simpan data header

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
                'pt_id' => $request->input('header.nama_pt'),
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
            return response()->json(['message' => 'Invoice berhasil disimpan.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan invoice.'], 500);
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
            'edit_kode_invoice' => ['required',  Rule::unique('invoice', 'kd_invoice')->where('pt_id', $request->input('edit_nama_pt'))->ignore($invoice->id)],
            'edit_header_deskripsi' => 'required',
            'edit_tanggal' => 'required|date',
            'edit_nama_client' => 'required|max:50',
            'edit_nama_pt' => 'required|max:50',
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
            'edit_kode_invoice.unique' => 'Kode invoice sudah digunakan untuk PT ini.',
            'edit_header_deskripsi.required' => 'Deskripsi header wajib diisi.',
            'edit_tanggal.required' => 'Tanggal wajib diisi.',
            'edit_tanggal.date' => 'Format tanggal tidak valid.',
            'edit_nama_client.required' => 'Nama client wajib diisi.',
            'edit_nama_client.max' => 'Nama client tidak boleh lebih dari 50 karakter.',
            'edit_nama_pt.required' => 'Nama PT wajib diisi.',
            'edit_nama_pt.max' => 'Nama PT tidak boleh lebih dari 50 karakter.',
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
            'pt_id' => $request->edit_nama_pt,
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


    public function viewTtd(string $id)
    {
        $ttd = Invoice::where('id', $id)->value('ttd');
        return response()->json($ttd, 200);
    }
    public function updateTtd(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'ttd' => 'required|in:true,false', // Hanya menerima 'true' atau 'false' // Validasi input radio button
        ]);

        // Update kolom ttd pada baris dengan ID yang sesuai
        Invoice::where('id', $id)->update(['ttd' => $validatedData['ttd']]);

        return response()->json(['message' => 'TTD updated successfully.'], 200);
    }


    public function delete(string $id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();
        return response()->json();
    }

    public function getKodeInvoice(Request $request)
    {
        $ptId = $request->input('pt_id');

        // Validasi PT ID
        if (!$ptId) {
            return response()->json(['error' => 'PT ID tidak valid.'], 400);
        }

        // Cari kode invoice terakhir untuk PT tertentu
        $dataTerakhir = Invoice::where('pt_id', $ptId)->latest('id')->first();
        $lastId = $dataTerakhir ? $dataTerakhir->kd_invoice : 0;
        $nextNumber = $lastId + 1;
        $kode = str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        return response()->json(['kode_invoice' => $kode]);
    }

    public function export(Request $request)
    {
        $ptId = $request->get('pt_id');
        $year = $request->get('tgl_invoice');

        // Query data berdasarkan filter
        $invoices = Invoice::query();

        if ($ptId) {
            $invoices->where('pt_id', $ptId);
        }
        if ($year) {
            $invoices->whereYear('tgl_invoice', $year);
        }

        $invoices = $invoices->get();

        // Ekspor data menggunakan Excel
        return Excel::download(new InvoiceExport($invoices), 'Invoice.xlsx');
    }
}
