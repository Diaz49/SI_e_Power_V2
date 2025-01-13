<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class PrintInvoiceController extends Controller
{
    public function view(string $id)
    {
        $invoice = Invoice::with('detail')->findOrFail($id);

        return view('invoice.print')->with('invoice', $invoice);
    }

    public function angkaTerbilang($angka) {
        // Ambil hanya bagian integer tanpa desimal
        $integerPart = floor($angka); // Bagian integer
        // Konversi bagian integer menjadi terbilang
        $terbilangInteger = $this->angkaTerbilangInteger($integerPart);
    
        // Kembalikan hanya bagian integer
        return $terbilangInteger ;
    }
    
    public function angkaTerbilangInteger($angka) {
        // Array angka terbilang
        $huruf = array(
            0 => '', 1 => 'Satu', 2 => 'Dua', 3 => 'Tiga', 4 => 'Empat', 5 => 'Lima', 
            6 => 'Enam', 7 => 'Tujuh', 8 => 'Delapan', 9 => 'Sembilan', 10 => 'Sepuluh', 
            11 => 'Sebelas', 12 => 'Dua Belas', 13 => 'Tiga Belas', 14 => 'Empat Belas', 
            15 => 'Lima Belas', 16 => 'Enam Belas', 17 => 'Tujuh Belas', 18 => 'Delapan Belas', 
            19 => 'Sembilan Belas', 20 => 'Dua Puluh', 30 => 'Tiga Puluh', 40 => 'Empat Puluh', 
            50 => 'Lima Puluh', 60 => 'Enam Puluh', 70 => 'Tujuh Puluh', 80 => 'Delapan Puluh', 
            90 => 'Sembilan Puluh', 100 => 'Seratus', 1000 => 'Seribu', 1000000 => 'Satu Juta', 
            1000000000 => 'Satu Miliar'
        );
    
        // Menangani angka kecil terlebih dahulu
        if ($angka < 21) {
            return $huruf[$angka];
        } elseif ($angka < 100) {
            $puluhan = (int)($angka / 10) * 10;
            $sisa = $angka % 10;
            return $huruf[$puluhan] . ' ' . $huruf[$sisa];
        } elseif ($angka < 1000) {
            $ratusan = (int)($angka / 100);
            $sisa = $angka % 100;
            return $huruf[$ratusan] . ' Ratus ' . $this->angkaTerbilangInteger($sisa);
        } elseif ($angka < 1000000) {
            $ribuan = (int)($angka / 1000);
            $sisa = $angka % 1000;
            return $this->angkaTerbilangInteger($ribuan) . ' Ribu ' . $this->angkaTerbilangInteger($sisa);
        } elseif ($angka < 1000000000) {
            $juta = (int)($angka / 1000000);
            $sisa = $angka % 1000000;
            return $this->angkaTerbilangInteger($juta) . ' Juta ' . $this->angkaTerbilangInteger($sisa);
        } else {
            return 'Angka terlalu besar';
        }
    }
    
}
