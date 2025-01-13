<?php

namespace App\Exports;

use App\Models\DataClient;
use Maatwebsite\Excel\Concerns\FromCollection;

class DataClientExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Ambil semua data klien
        return DataClient::all();
    }
}
