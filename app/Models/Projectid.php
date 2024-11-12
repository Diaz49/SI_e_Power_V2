<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projectid extends Model
{
    use HasFactory;

    protected $table = 'project_id';

    protected $fillable = [
        'project_id',
        'nama_project',
        'nama_client',
        'alamat',
        'hpp',
        'rab',
    ];
}
