<?php

namespace App\Exports;

use App\Models\Bast;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet; // Pastikan ini adalah Events
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithEvents;

class BastExport implements FromCollection, WithHeadings, WithMapping, WithCustomStartCell, WithStyles, WithEvents
{
    public function collection()
    {
        return Bast::with('pt')->get(); // Ambil data klien beserta relasi PT
    }

    /**
     * Tentukan cell awal data
     */
    public function startCell(): string
    {
        return 'A4'; // Data mulai dari cell A4
    }

    /**
     * Tentukan header (judul) di atas data
     */
    public function headings(): array
    {
        return [
            'Tanggal',
            'Kode Invoice',
            'Deskripsi',
            'Nama',
            'Jabatan',
            'Jumlah Item',
            'Harga Satuan',
            'Total Invoice',
            'Tanggal Dibuat',
            'Nama PT',
        ];
    }

    /**
     * Tentukan format data yang diekspor
     */
    public function map($bast): array
    {
        return [
            $bast->tanggal,
            $bast->invoice->kd_invoice,
            $bast->deskripsi,
            $bast->nama,
            $bast->jabatan,
            $bast->jumlah_item,
            $bast->harga_satuan,
            $bast->total_invoice,
            $bast->created_at ? $bast->created_at->format('d-m-Y') : 'N/A',
            $bast->pt->nama_pt ?? 'N/A',
        ];
    }

    /**
     * Tambahkan styling untuk header
     */
    public function styles(Worksheet $sheet)
    {
        return [
            'A1' => ['font' => ['bold' => true, 'size' => 14]],
            'A4:J4' => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }

    /**
     * Daftarkan event untuk customisasi sheet
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

            // Menambahkan custom header
            $sheet->setCellValue('A1', 'Laporan Data Bast');

            // Merge cell dari A1 sampai G1
            $sheet->mergeCells('A1:J1');

            // Mengatur teks agar berada di tengah (horizontal dan vertikal)
            $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
            $sheet->getStyle('A1')->getAlignment()->setVertical('center');

            // Menambahkan tanggal laporan di bawah judul
            $sheet->setCellValue('A2', 'Tanggal: ' . now()->format('d-m-Y'));
            // $sheet->mergeCells('A2:G2');
            // $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');

                // Menyesuaikan ukuran kolom
                foreach (range('A', 'J') as $column) {
                    $sheet->getColumnDimension($column)->setAutoSize(true);
                }
            },
        ];
    }
}
