<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoice';
    protected $fillable = [
        'kd_invoice',
        'tgl_invoice',
        'client_id',
        'no_bast',
        'no_bast_2',
        'no_bast_3',
        'no_bast_4',
        'no_bast_5',
        'kd_admin',
        'jenis_no',
        'no_3',
        'no_4',
        'no_5',
        'due',
        'bank_id',
        'no_fp',
        'status',
        'tgl_paid'
    ];
}
