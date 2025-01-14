<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataVendor extends Model
{
    use HasFactory;

    protected $table = 'vendor';

    protected $fillable = [
       'nama_vendor',        
       'alamat_vendor',
       'kota', 
       'no_tlp',
       'email',
       'up',
       'pt_id', 
    ];

    public function pt()
    {
        return $this->belongsTo(PT::class);
    } 
}
