<?php

namespace App\Exports;

use App\Models\Po;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet; // Pastikan ini adalah Events
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithEvents;

class PoExport implements FromCollection, WithHeadings, WithMapping, WithCustomStartCell, WithStyles, WithEvents
{
    public function collection()
    {
        return Po::with('detail', 'vendor')->get(); // Ambil data klien beserta relasi PT
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
            'Kode PO',
            'Tanggal PO',
            'Nama Vendor',
            'Alamat Vendor',
            'Total Harga PO',
            'Diskon',
            'Total Harga',
            'PPN',
            'Grand Total',
            'Tanggal Dibuat',
        ];
    }

    /**
     * Tentukan format data yang diekspor
     */
    public function map($po): array
    {
        // Menghitung total harga
        $total_harga = $po->detail->sum('jumlah_harga');
        $total_diskon = $po->diskon;
        $hasil_total = $total_harga - $total_diskon;
        $ppn = $hasil_total * 0.11;
        $hasil_final = $hasil_total + $ppn;
    
        // Membulatkan nilai ke angka terdekat
        $ppn = round($ppn);
        $hasil_final = round($hasil_final);
    
        // Mengembalikan array
        return [
            $po->kode_po,
            $po->tanggal_po,
            $po->vendor->nama_vendor,
            $po->vendor->alamat_vendor,
            $total_harga,
            $total_diskon,
            $hasil_total,
            $ppn,
            $hasil_final,
            $po->updated_at ? $po->updated_at->format('d-m-Y') : 'N/A',
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
            $sheet->setCellValue('A1', 'Laporan Data Purchase Order');

            // Merge cell dari A1 sampai J1
            $sheet->mergeCells('A1:J1');

            // Mengatur teks agar berada di tengah (horizontal dan vertikal)
            $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
            $sheet->getStyle('A1')->getAlignment()->setVertical('center');

            // Menambahkan tanggal laporan di bawah judul
            $sheet->setCellValue('A2', 'Tanggal: ' . now()->format('d-m-Y'));

                // Menyesuaikan ukuran kolom
                foreach (range('A', 'J') as $column) {
                    $sheet->getColumnDimension($column)->setAutoSize(true);
                }
            },
        ];
    }
}
