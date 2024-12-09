<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPo extends Model
{
    use HasFactory;

    protected $table = 'po_detail';
    protected $fillable = [
        'po_id',
        'nama_barang',
        'qty',
        'satuan',
        'harga_satuan',
    ];

    public function po()
    {
        return $this->belongsTo(Po::class, 'po_id');
    }
}
