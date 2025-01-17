<?php

namespace App\Exports;

use App\Models\Sph;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet; // Pastikan ini adalah Events
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithEvents;

class SphExport implements FromCollection, WithHeadings, WithMapping, WithCustomStartCell, WithStyles, WithEvents
{
    public function collection()
    {
        return Sph::with('detailSph', 'dataClient')->get(); // Ambil data klien beserta relasi PT
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
            'Kode Sph',
            'Nama Client',
            'Up SPH',
            'Total Harga',
            'Penawaran Harga',
            'Kode Admin',
            'Tanggal Dibuat',
        ];
    }

    /**
     * Tentukan format data yang diekspor
     */
    public function map($sph): array
    {
        return [
            $sph->tanggal,
            $sph->kode_sph,
            $sph->dataClient->nama_client,
            $sph->dataClient->up_sph,
            $sph->detailSph->sum('jumlah_harga'),
            $sph->penawaran_harga,
            $sph->kd_admin,
            $sph->created_at ? $sph->created_at->format('d-m-Y') : 'N/A',
        ];
    }

    /**
     * Tambahkan styling untuk header
     */
    public function styles(Worksheet $sheet)
    {
        return [
            'A1' => ['font' => ['bold' => true, 'size' => 14]],
            'A4:H4' => ['font' => ['bold' => true, 'size' => 12]],
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
            $sheet->setCellValue('A1', 'Laporan SPH (Surat Penawaran Harga)');

            // Merge cell dari A1 sampai G1
            $sheet->mergeCells('A1:H1');

            // Mengatur teks agar berada di tengah (horizontal dan vertikal)
            $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
            $sheet->getStyle('A1')->getAlignment()->setVertical('center');

            // Menambahkan tanggal laporan di bawah judul
            $sheet->setCellValue('A2', 'Tanggal: ' . now()->format('d-m-Y'));

                // Menyesuaikan ukuran kolom
                foreach (range('A', 'H') as $column) {
                    $sheet->getColumnDimension($column)->setAutoSize(true);
                }
            },
        ];
    }
}
