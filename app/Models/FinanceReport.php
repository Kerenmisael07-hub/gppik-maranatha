<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinanceReport extends Model
{
    protected $fillable = [
        'tanggal',
        'keterangan',
        'kategori',
        'jumlah',
    ];
    protected $casts = [
        'tanggal' => 'date',
        'jumlah' => 'decimal:2',
    ];
}
