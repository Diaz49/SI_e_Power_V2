<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Po extends Model
{
    use HasFactory;

    protected $table = 'po';
    protected $fillable = [
        'kode_po',
        'tanggal_po',
        'vendor_id',
        'buyer_id',
        'catatan',
        'catatan_2',
        'diskon',
    ];
}
