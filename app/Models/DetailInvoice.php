<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailInvoice extends Model
{
    use HasFactory;

    protected $table = 'invoice_detail';
    protected $fillable = [
        'invoice_id',
        'nama_barang',
        'qty',
        'satuan',
        'harga_satuan',
        'jumlah_harga',
    ];

    public function invoice(){
        return $this->belongsTo(Invoice::class,'invoice_id');
    }
}
