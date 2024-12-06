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
        'buyer',
        'perihal',
        'catatan',
        'catatan_2',
        'diskon',
    ];

    public function vendor()
    {
        return $this->belongsTo(DataVendor::class, 'vendor_id');
    }
    public function detail()
    {
        return $this->hasMany(DetailPo::class, 'po_id', 'id');
    }
}
