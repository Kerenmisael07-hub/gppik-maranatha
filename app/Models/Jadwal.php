<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $fillable = [
        'tanggal_waktu',
        'jenis_acara',
        'pelayan_firman',
    ];
    protected $casts = [
        'tanggal_waktu' => 'datetime',
    ];
}
