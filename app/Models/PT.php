<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PT extends Model
{
    use HasFactory;

    protected $table = 'pt';

    protected $fillable = [ 
        'nama_pt',
        'kode_pt', 
    ];

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

}
