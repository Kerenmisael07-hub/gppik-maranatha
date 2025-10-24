<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nyanyian extends Model
{
    protected $fillable = [
        'nomor_lagu',
        'judul_lagu',
        'kategori',
        'sumber_buku',
        'lirik',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'nomor_lagu' => 'integer',
    ];

    // Scope untuk hanya menampilkan lagu aktif
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    // Scope untuk pencarian
    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('nomor_lagu', 'like', "%{$search}%")
              ->orWhere('judul_lagu', 'like', "%{$search}%")
              ->orWhere('lirik', 'like', "%{$search}%");
        });
    }

    // Scope untuk filter kategori
    public function scopeByKategori($query, $kategori)
    {
        if ($kategori) {
            return $query->where('kategori', $kategori);
        }
        return $query;
    }

    // Scope untuk filter sumber buku
    public function scopeBySumberBuku($query, $sumber)
    {
        if ($sumber) {
            return $query->where('sumber_buku', $sumber);
        }
        return $query;
    }

    // Konstanta untuk dropdown options
    const KATEGORI_OPTIONS = [
        'Pujian' => 'Pujian',
        'Penyembahan' => 'Penyembahan',
        'Ucapan Syukur' => 'Ucapan Syukur',
        'Natal' => 'Natal',
        'Paskah' => 'Paskah',
        'Penginjilan' => 'Penginjilan',
        'Doa' => 'Doa',
        'Lainnya' => 'Lainnya',
    ];

    const SUMBER_BUKU_OPTIONS = [
        'NHYK' => 'NHYK (Nyanyian Hidup Yang Kekal)',
    ];
}
