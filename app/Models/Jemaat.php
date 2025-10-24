<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jemaat extends Model
{
    protected $fillable = [
        'nama_lengkap',
        'tgl_lahir',
        'status_baptis',
        'status_sidi',
        'sektor',
        'alamat',
        'telepon',
        'pekerjaan',
        'keluarga',
    ];
    protected $casts = [
        'tgl_lahir' => 'date',
    ];
}
