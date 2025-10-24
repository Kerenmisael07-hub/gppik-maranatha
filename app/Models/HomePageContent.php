<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePageContent extends Model
{
    protected $table = 'homepage_contents';
    
    protected $fillable = [
        'type',
        'title',
        'content',
        'image_path',
        'image_position',
        'images',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
        'images' => 'array'
    ];

    /**
     * Scope untuk konten aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk ordering
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    /**
     * Scope untuk filter by type
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }
}
