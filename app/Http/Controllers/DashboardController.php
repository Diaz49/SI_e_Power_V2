<?php

namespace App\Http\Controllers;

use App\Models\PT;
use App\Models\Invoice;
use App\Models\DetailInvoice;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    
    public function index()
    {
        // Ambil data Invoice yang sudah paid
        $invoices = Invoice::where('status', 'paid')->with(['pt', 'detail'])->get();

        // Ambil tahun sekarang
        $currentYear = Carbon::now()->year;

        // Proses data untuk chart per PT
        $chartData = $invoices->groupBy('pt')->map(function ($invoiceGroup, $ptId) use ($currentYear) {
            // Default data untuk 12 bulan (nilai awal 0)
            $monthlyData = array_fill(1, 12, 0);

            foreach ($invoiceGroup as $invoice) {
                // Pastikan invoice berada di tahun yang sesuai
                if ($invoice->updated_at->year === $currentYear) {
                    foreach ($invoice->detail as $detail) {
                        if ($detail->updated_at) {
                            $month = $detail->updated_at->month; // Ambil bulan dari updated_at
                            $monthlyData[$month] += $detail->jumlah_harga; // Jumlahkan harga
                        }
                    }
                }
            }

            return [
                'kode_pt' => $ptId,
                'nama_pt' => $invoiceGroup->first()->pt->nama_pt ?? 'Unknown',
                'monthlyData' => array_values($monthlyData),
            ];
        })->values(); // Reset keys untuk array chartData

        // Ambil data invoice bulan ini dengan status 'paid'
        $currentMonthData = Invoice::where('status', 'paid')
            ->with(['pt', 'detail'])
            ->whereMonth('updated_at', now()->month)
            ->get();

        // Ambil data invoice bulan kemarin dengan status 'paid'
        $lastMonthData = Invoice::where('status', 'paid')
            ->with(['pt', 'detail'])
            ->whereMonth('updated_at', now()->subMonth()->month)
            ->get();

        // Proses data untuk perbandingan per PT
        $comparisonData = PT::all()->map(function ($pt) use ($currentMonthData, $lastMonthData) {
            // Filter data berdasarkan kode_pt dari relasi
            $currentMonthInvoices = $currentMonthData->filter(function ($invoice) use ($pt) {
                return $invoice->pt->kode_pt == $pt->kode_pt;
            });
            $lastMonthInvoices = $lastMonthData->filter(function ($invoice) use ($pt) {
                return $invoice->pt->kode_pt == $pt->kode_pt;
            });

            // Hitung total jumlah_harga per bulan
            $currentTotal = $currentMonthInvoices->flatMap(function ($invoice) {
                return $invoice->detail;
            })->sum('jumlah_harga');

            $lastTotal = $lastMonthInvoices->flatMap(function ($invoice) {
                return $invoice->detail;
            })->sum('jumlah_harga');

            $changeDifference = $currentTotal - $lastTotal;

            // Hitung persentase perubahan
            $percentageChange = $lastTotal > 0 ? (($currentTotal - $lastTotal) / $lastTotal) * 100 : 0;

            return [
                'nama_pt' => $pt->nama_pt,
                'kode_pt' => $pt->kode_pt,
                'changeDifference' => $changeDifference,
                'percentageChange' => $percentageChange,
            ];
        });

        // Return data ke view
        return view('dashboard.dashboard', compact('chartData', 'comparisonData'));

    }
    


}
