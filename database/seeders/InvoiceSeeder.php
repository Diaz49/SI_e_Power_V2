<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\DetailInvoice;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class InvoiceSeeder extends Seeder
{
    public function run()
    {
            
        for ($i = 1; $i <= 100; $i++) {
            // Ambil ID acak dari tabel client, pt, dan bank
            $client_id = DB::table('client')->inRandomOrder()->value('id');
            $pt_id = DB::table('pt')->inRandomOrder()->value('id');
            // $pt_id = DB::table('pt')->where('kode_pt', 'MPA')->inRandomOrder()->value('id');
            $bank_id = DB::table('bank')->inRandomOrder()->value('id');
        
            $status_options = ['paid', 'paid', 'paid', '-']; // Perbesar kemungkinan status 'paid'
            // // Mendapatkan bulan dan tahun sekarang
            // {
            //     $currentMonth = Carbon::now()->month;
            //     $currentYear = Carbon::now()->year;

            //     // Membuat updated_at di bulan sekarang (random tanggal, jam, menit, detik)
            //     $updated_at = Carbon::create($currentYear, $currentMonth, rand(1, Carbon::now()->daysInMonth), rand(0, 23), rand(0, 59), rand(0, 59));

            //     // Membuat created_at yang lebih awal atau sama dengan updated_at
            //     $create_at = Carbon::create($currentYear, $currentMonth, rand(1, Carbon::now()->daysInMonth), rand(0, 23), rand(0, 59), rand(0, 59));

            //     // Pastikan created_at tidak lebih dari updated_at
            //     while ($create_at->greaterThan($updated_at)) {
            //         $create_at = Carbon::create($currentYear, $currentMonth, rand(1, Carbon::now()->daysInMonth), rand(0, 23), rand(0, 59), rand(0, 59));
            //     }
            // }

            // // Mendapatkan bulan dan tahun 2024
            // {
            //     // Membuat updated_at di bulan Desember 2024
            //     $updated_at = Carbon::create(2024, 12, rand(1, 31), rand(0, 23), rand(0, 59), rand(0, 59));

            //     // Membuat created_at yang lebih awal atau sama dengan updated_at
            //     $create_at = Carbon::create(2024, 12, rand(1, 31), rand(0, 23), rand(0, 59), rand(0, 59));

            //     // Pastikan created_at tidak lebih dari updated_at
            //     while ($create_at->greaterThan($updated_at)) {
            //         $create_at = Carbon::create(2024, 12, rand(1, 31), rand(0, 23), rand(0, 59), rand(0, 59));
            //     }
            // }

            // Acak tahun antara 2024 dan 2025
            {
                $year = rand(2024, 2025);
                $year = 2025;

                // Acak bulan dalam setahun
                $month = rand(1, 2);

                // Jumlah hari dalam bulan tersebut
                $daysInMonth = Carbon::create($year, $month)->daysInMonth;

                // Random updated_at
                $updated_at = Carbon::create(
                    $year,
                    $month,
                    rand(1, $daysInMonth), // Tanggal
                    rand(0, 23),           // Jam
                    rand(0, 59),           // Menit
                    rand(0, 59)            // Detik
                );

                // Random created_at (harus <= updated_at)
                $created_at = Carbon::create(
                    $year,
                    $month,
                    rand(1, $daysInMonth), // Tanggal
                    rand(0, 23),           // Jam
                    rand(0, 59),           // Menit
                    rand(0, 59)            // Detik
                );

                while ($created_at->greaterThan($updated_at)) {
                    $created_at = Carbon::create(
                        $year,
                        $month,
                        rand(1, $daysInMonth),
                        rand(0, 23),
                        rand(0, 59),
                        rand(0, 59)
                    );
                }
            }
            

            $invoice = Invoice::create([
                
                'kd_invoice' => 'INV-' . strtoupper(Str::random(8)),
                'header_deskripsi' => 'Deskripsi header untuk invoice ' . $i,
                'tgl_invoice' => Carbon::now()->subDays(rand(1, 30)),
                'client_id' => $client_id,
                'pt_id' => $pt_id,
                'no_bast_1' => 'BAST-' . strtoupper(Str::random(6)),
                'no_bast_2' => rand(0, 1) ? 'BAST-' . strtoupper(Str::random(6)) : null,
                'no_bast_3' => rand(0, 1) ? 'BAST-' . strtoupper(Str::random(6)) : null,
                'no_bast_4' => rand(0, 1) ? 'BAST-' . strtoupper(Str::random(6)) : null,
                'no_bast_5' => rand(0, 1) ? 'BAST-' . strtoupper(Str::random(6)) : null,
                'kd_admin' => rand(0, 1) ? 'ADM-' . strtoupper(Str::random(5)) : null,
                'jenis_no' => ['PO', 'Kontrak', 'SPK', 'SPPK', 'FPB'][array_rand(['PO', 'Kontrak', 'SPK', 'SPPK', 'FPB'])],
                'no_1' => 'NO-' . strtoupper(Str::random(5)),
                'no_2' => rand(0, 1) ? 'NO-' . strtoupper(Str::random(5)) : null,
                'no_3' => rand(0, 1) ? 'NO-' . strtoupper(Str::random(5)) : null,
                'no_4' => rand(0, 1) ? 'NO-' . strtoupper(Str::random(5)) : null,
                'no_5' => rand(0, 1) ? 'NO-' . strtoupper(Str::random(5)) : null,
                'due' => Carbon::now()->addDays(rand(10, 30)),
                'bank_id' => $bank_id,
                'no_fp' => rand(0, 1) ? 'FP-' . strtoupper(Str::random(8)) : null,
                'status' => $status_options[array_rand($status_options)],
                'tgl_paid' => rand(0, 1) ? Carbon::now()->subDays(rand(1, 15)) : null,
                'created_at' => Carbon::now(),
                'updated_at' => $updated_at,
            ]);
        
            for ($j = 1; $j <= rand(2, 5); $j++) {
                DetailInvoice::create([
                    'invoice_id' => $invoice->id,
                    'nama_barang' => 'Barang ' . $j,
                    'qty' => rand(1, 50),
                    'satuan' => ['pcs', 'box', 'kg', 'liter'][array_rand(['pcs', 'box', 'kg', 'liter'])],
                    'harga_satuan' => rand(1000, 50000),
                    'jumlah_harga' => rand(1000, 50000) * rand(1, 50),
                    'created_at' => Carbon::now(),
                    'updated_at' => $updated_at,
                ]);
            }
        }
        

    }
}

