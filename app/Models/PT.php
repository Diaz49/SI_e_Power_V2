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
        return $this->hasMany(DataClient::class);
    }

    public function invoice(){
        return $this->hasMany(Invoice::class, 'pt_id','id');
    }

    public function bast(){
        return $this->hasMany(Bast::class, 'pt_id','id');
    }

    public function project_id()
    {
        return $this->hasMany(Projectid::class);
    }

}
