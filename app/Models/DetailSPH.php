<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSPH extends Model
{
    use HasFactory;
    protected $table = 'sph_detail';
    protected $fillable = [
        'sph_id',
        'nama_project',
        'qty',
        'satuan',
        'harga_satuan',
        'jumlah_harga',
    ];

    public function sph()
    {
        return $this->belongsTo(Sph::class, 'sph_id');
    }
}
