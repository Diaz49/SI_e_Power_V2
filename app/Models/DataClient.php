<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataClient extends Model
{
    use HasFactory;

    protected $table = 'client';

    protected $fillable = [
        'nama_client',
        'alamat',
        'no_tlp',
        'up_invoice',
        'up_sph',
    ];

    public function sphs()
    {
        return $this->hasMany(Sph::class, 'data_client_id', 'id');
    }

    public function invoice(){
        return $this->hasMany(Invoice::class, 'client_id', 'id');
    }

    public function pt()
    {
        return $this->belongsTo(PT::class);
    }   

}
