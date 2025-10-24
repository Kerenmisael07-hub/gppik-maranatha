<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomePageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomePageContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contents = HomePageContent::ordered()->get();
        return view('admin.homepage_content.index', compact('contents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.homepage_content.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:hero,text,image',
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'image_position' => 'nullable|in:left,right',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean'
        ]);

        // Handle single image upload
        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('homepage', 'public');
        }

        // Handle multiple images upload
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('homepage', 'public');
            }
            $validated['images'] = $imagePaths;
        }

        $validated['image_position'] = $request->input('image_position', 'right');
        $validated['is_active'] = $request->has('is_active') ? true : false;
        $validated['order'] = $validated['order'] ?? HomePageContent::max('order') + 1;

        HomePageContent::create($validated);

        return redirect()->route('admin.homepage_content.index')
            ->with('success', 'Konten berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HomePageContent $homepageContent)
    {
        return view('admin.homepage_content.edit', compact('homepageContent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HomePageContent $homepageContent)
    {
        $validated = $request->validate([
            'type' => 'required|in:hero,text,image',
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'image_position' => 'nullable|in:left,right',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
            'existing_images' => 'nullable|json',
            'deleted_images' => 'nullable|json'
        ]);

        // Handle single image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($homepageContent->image_path && Storage::disk('public')->exists($homepageContent->image_path)) {
                Storage::disk('public')->delete($homepageContent->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('homepage', 'public');
        }

        // Handle multiple images
        $existingImages = $request->input('existing_images') ? json_decode($request->input('existing_images'), true) : [];
        $deletedImages = $request->input('deleted_images') ? json_decode($request->input('deleted_images'), true) : [];
        
        // Delete removed images from storage
        foreach ($deletedImages as $deletedImage) {
            if (Storage::disk('public')->exists($deletedImage)) {
                Storage::disk('public')->delete($deletedImage);
            }
        }
        
        // Start with existing images (reordered)
        $finalImages = $existingImages;
        
        // Add newly uploaded images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $finalImages[] = $image->store('homepage', 'public');
            }
        }
        
        // Update images if there are any changes
        if (!empty($finalImages) || !empty($deletedImages) || $request->hasFile('images')) {
            $validated['images'] = $finalImages;
        }

        $validated['image_position'] = $request->input('image_position', $homepageContent->image_position ?? 'right');
        $validated['is_active'] = $request->has('is_active') ? true : false;

        $homepageContent->update($validated);

        return redirect()->route('admin.homepage_content.index')
            ->with('success', 'Konten berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HomePageContent $homepageContent)
    {
        // Delete image if exists
        if ($homepageContent->image_path && Storage::disk('public')->exists($homepageContent->image_path)) {
            Storage::disk('public')->delete($homepageContent->image_path);
        }

        $homepageContent->delete();

        return redirect()->route('admin.homepage_content.index')
            ->with('success', 'Konten berhasil dihapus!');
    }
}
