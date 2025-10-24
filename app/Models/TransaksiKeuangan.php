<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiKeuangan extends Model
{
    protected $fillable = [
        'tanggal',
        'keterangan',
        'jenis', // 'Pemasukan' atau 'Pengeluaran'
        'jumlah',
    ];
    protected $casts = [
        'tanggal' => 'date',
        'jumlah' => 'integer',
    ];
}
