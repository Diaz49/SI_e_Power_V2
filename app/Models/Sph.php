<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sph extends Model
{
    use HasFactory;

    protected $table = 'sph'; // Nama tabel

    protected $fillable = [
        'project', 
        'item', 
        'unit', 
        'price', 
        'kode_sph', 
        'tanggal', 
        'data_client_id', 
        'up', 
        'penawaran_harga'
    ];

    public function dataClient()
    {
        return $this->belongsTo(DataClient::class, 'data_client_id', 'id');
    }
}
