<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class InvoiceExport implements FromCollection, WithHeadings, WithStyles, WithTitle, WithEvents, WithCustomStartCell
{
    protected $invoices;

    public function __construct($invoices)
    {
        $this->invoices = $invoices;
    }

    public function collection()
    {
        $no = 1;

        return $this->invoices->map(function ($invoice) use (&$no) {
            $jumlahHarga = $invoice->detail->sum('jumlah_harga');
            $ppn = $jumlahHarga * 11 / 100;
            $total = $jumlahHarga + $ppn;
            return [
                'No' => $no++,
                'Kode Invoice' => $invoice->kd_invoice,
                'Tanggal' => $invoice->tgl_invoice,
                'Nama Client' => $invoice->client->nama_client,
                'Up' => $invoice->client->up_invoice,
                'No Bast' => $invoice->no_bast_1,
                'Jenis' => $invoice->jenis_no,
                'No Kontrak' => $invoice->no_1,
                'Due Date' => $invoice->due,
                'Deskripsi' => $invoice->header_deskripsi,
                'Jumlah' => number_format(floor($invoice->detail->sum('jumlah_harga')), 0, ',', '.'),
                'PPN' =>  number_format(floor($ppn), 0, ',', '.'),
                'Total' =>  number_format(floor($total), 0, ',', '.'),
                'Nama Bank' => $invoice->bank->nama_bank,
                'An' => $invoice->bank->nama_rek,
                'Ac' => $invoice->bank->no_rek,
                'PT' => $invoice->pt->nama_pt,
                'No. FP' => $invoice->no_fp,
                'Status' => $invoice->status,
                'Tgl Paid' => $invoice->tgl_paid,
            ];
        });
    }
    public function startCell(): string
    {
        return 'A2'; // Data mulai dari cell A4
    }

    public function headings(): array
    {
        return [
            'No',
            'Kode Invoice',
            'Tanggal',
            'Nama Client',
            'Up',
            'No Bast',
            'Jenis',
            'No Kontrak',
            'Due Date',
            'Deskripsi',
            'Jumlah',
            'PPN',
            'Total',
            'Nama Bank',
            'An',
            'Ac',
            'PT',
            'No. FP',
            'Status',
            'Tgl Paid',
        ];
    }


    public function styles(Worksheet $sheet)
    {
        // Atur judul "Data Invoice" pada baris pertama
        $sheet->mergeCells('A1:T1'); // Sesuaikan dengan jumlah kolom
        $sheet->setCellValue('A1', 'Data Invoice');

        // Gaya untuk judul
        $sheet->getStyle('A1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Gaya untuk tabel (baris kedua dan seterusnya)
        $sheet->getStyle('A2:T2')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ]);

        // Border untuk seluruh data
        $sheet->getStyle('A2:T' . ($sheet->getHighestRow()))->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ]);
    }

    public function title(): string
    {
        return 'Invoice Report';
    }

    public function registerEvents(): array
    {
        return [];
    }
}
