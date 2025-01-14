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
        'pt_id',
        'deskripsi',
        'nama',
        'jabatan',
        'jumlah_item',
        'harga_satuan',
        'total_invoice',
    ];

    public function invoice(){
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
    public function pt(){
        return $this->belongsTo(PT::class, 'pt_id');
    }
}
