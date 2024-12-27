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
        'header_deskripsi',
        'tgl_invoice',
        'client_id',
        'no_bast_1',
        'no_bast_2',
        'no_bast_3',
        'no_bast_4',
        'no_bast_5',
        'kd_admin',
        'jenis_no',
        'no_1',
        'no_2',
        'no_3',
        'no_4',
        'no_5',
        'due',
        'bank_id',
        'no_fp',
        'status',
        'tgl_paid'
    ];

    public function detail()
    {
        return $this->hasMany(DetailInvoice::class, 'invoice_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(DataClient::class, foreignKey: 'client_id');
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class, foreignKey: 'bank_id');
    }
}
