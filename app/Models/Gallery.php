<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'media_type',
        'title',
        'image_path',
        'video_path',
        'thumbnail_path',
        'description'
    ];

    /**
     * Check if this gallery item is a video
     */
    public function isVideo()
    {
        return $this->media_type === 'video';
    }

    /**
     * Check if this gallery item is an image
     */
    public function isImage()
    {
        return $this->media_type === 'image';
    }

    /**
     * Get the display path (image or thumbnail)
     */
    public function getDisplayPath()
    {
        if ($this->isVideo()) {
            return $this->thumbnail_path ?? $this->image_path;
        }
        return $this->image_path;
    }
}
