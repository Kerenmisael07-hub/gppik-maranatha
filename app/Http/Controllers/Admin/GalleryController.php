<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $items = Gallery::orderBy('created_at','desc')->paginate(12);
        return view('admin.galeri.index', compact('items'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'media_type' => 'required|in:image,video',
            'title' => 'required|string|max:255',
            'image' => 'required_if:media_type,image|image|mimes:jpeg,png,jpg|max:2048',
            'video' => 'required_if:media_type,video|file|mimes:mp4,avi,mov,wmv|max:51200', // max 50MB
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable|string',
        ]);

        $galleryData = [
            'media_type' => $data['media_type'],
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
        ];

        if ($data['media_type'] === 'image') {
            $galleryData['image_path'] = $request->file('image')->store('gallery', 'public');
        } else {
            // Upload video
            $galleryData['video_path'] = $request->file('video')->store('gallery/videos', 'public');
            
            // Upload thumbnail if provided, otherwise use default
            if ($request->hasFile('thumbnail')) {
                $galleryData['thumbnail_path'] = $request->file('thumbnail')->store('gallery/thumbnails', 'public');
            }
        }

        Gallery::create($galleryData);
        
        $message = $data['media_type'] === 'image' ? 'Gambar berhasil diunggah.' : 'Video berhasil diunggah.';
        return redirect()->route('admin.galeri_foto')->with('success', $message);
    }

    public function show(Gallery $gallery)
    {
        return view('admin.galeri.show', compact('gallery'));
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.galeri.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $data = $request->validate([
            'media_type' => 'required|in:image,video',
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'video' => 'nullable|file|mimes:mp4,avi,mov,wmv|max:51200',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable|string',
        ]);

        $gallery->media_type = $data['media_type'];
        $gallery->title = $data['title'];
        $gallery->description = $data['description'] ?? null;

        // Handle image upload for image type
        if ($data['media_type'] === 'image' && $request->hasFile('image')) {
            // Delete old files
            if ($gallery->image_path) Storage::disk('public')->delete($gallery->image_path);
            if ($gallery->video_path) Storage::disk('public')->delete($gallery->video_path);
            if ($gallery->thumbnail_path) Storage::disk('public')->delete($gallery->thumbnail_path);
            
            $gallery->image_path = $request->file('image')->store('gallery', 'public');
            $gallery->video_path = null;
            $gallery->thumbnail_path = null;
        }

        // Handle video upload for video type
        if ($data['media_type'] === 'video') {
            if ($request->hasFile('video')) {
                // Delete old video
                if ($gallery->video_path) Storage::disk('public')->delete($gallery->video_path);
                $gallery->video_path = $request->file('video')->store('gallery/videos', 'public');
            }
            
            if ($request->hasFile('thumbnail')) {
                // Delete old thumbnail
                if ($gallery->thumbnail_path) Storage::disk('public')->delete($gallery->thumbnail_path);
                $gallery->thumbnail_path = $request->file('thumbnail')->store('gallery/thumbnails', 'public');
            }
            
            // Clear image_path for video type
            if ($gallery->image_path) {
                Storage::disk('public')->delete($gallery->image_path);
                $gallery->image_path = null;
            }
        }

        $gallery->save();
        return redirect()->route('admin.galeri_foto')->with('success', 'Media diperbarui.');
    }

    public function destroy(Gallery $gallery)
    {
        // Delete all associated files
        if ($gallery->image_path) Storage::disk('public')->delete($gallery->image_path);
        if ($gallery->video_path) Storage::disk('public')->delete($gallery->video_path);
        if ($gallery->thumbnail_path) Storage::disk('public')->delete($gallery->thumbnail_path);
        
        $gallery->delete();
        return redirect()->route('admin.galeri_foto')->with('success', 'Media dihapus.');
    }
}

