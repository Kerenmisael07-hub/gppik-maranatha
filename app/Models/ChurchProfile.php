<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChurchProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'content', 
        'welcome_text', 
        'visi', 
        'misi', 
        'sejarah', 
        'foto_kiri', 
        'foto_kanan',
        'alamat',
        'telepon',
        'email'
    ];
}