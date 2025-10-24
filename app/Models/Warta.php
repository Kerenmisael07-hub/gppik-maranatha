<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warta extends Model
{
    use HasFactory;

    protected $fillable = ['title','slug','excerpt','content','published_at'];

    protected $dates = ['published_at'];
}
