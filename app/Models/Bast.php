<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bast extends Model
{
    use HasFactory;

    protected $table = 'bast';

    protected $fillable = [
        'tanggal',
        'invoice_id',
        'deskripsi',
        'nama',
        'jabatan',
        'jumlah_item',
        'harga_satuan',
        'total_invoice',
    ];

    public function invoice(){
        return $this->belongTo(Invoice::class, 'invoice_id');
    }
}
