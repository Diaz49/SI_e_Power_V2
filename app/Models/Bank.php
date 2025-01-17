<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $table = 'bank';

    protected $fillable = [
        'nama_bank',
        'nama_rek',
        'nomer_rek',
        'status',
    ];

    public function invoice(){
        return $this->hasMany(Invoice::class, 'bank_id', 'id');
    }

}
