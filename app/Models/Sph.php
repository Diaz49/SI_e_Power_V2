<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sph extends Model
{
    use HasFactory;

    protected $table = 'sph'; // Nama tabel

    protected $fillable = [ 
        'kode_sph', 
        'kode',
        'tanggal', 
        'data_client_id', 
        'penawaran_harga',
        'kd_admin'
    ];

    public function dataClient()
    {
        return $this->belongsTo(DataClient::class, 'data_client_id', 'id');
    }
    public function detailSph()
    {
        return $this->hasMany(DetailSPH::class, 'sph_id', 'id');
    }
}
