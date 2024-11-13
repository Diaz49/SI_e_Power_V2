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
        'up_invoice',
        'up_sph',
    ];
}
