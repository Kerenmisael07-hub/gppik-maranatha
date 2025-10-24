<?php

namespace App\Http\Controllers;

use App\Models\Nyanyian;
use App\Models\Pengaturan;
use App\Models\ChurchProfile;
use App\Models\Gallery;
use App\Models\HomePageContent;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $contents = HomePageContent::active()->ordered()->get();
        
        return view('welcome', compact('contents'));
    }

    public function galeri()
    {
        $galleries = Gallery::where('media_type', 'image')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('public.galeri', compact('galleries'));
    }

    public function video()
    {
        $videos = Gallery::where('media_type', 'video')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('public.video', compact('videos'));
    }

    public function kontak()
    {
        return view('public.kontak');
    }

    public function warta()
    {
        $wartas = \App\Models\Warta::whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->paginate(9);
        return view('public.warta', compact('wartas'));
    }

    public function wartaDetail($slug)
    {
        $warta = \App\Models\Warta::where('slug', $slug)
            ->whereNotNull('published_at')
            ->firstOrFail();
        $latest = \App\Models\Warta::whereNotNull('published_at')
            ->where('id', '!=', $warta->id)
            ->orderBy('published_at', 'desc')
            ->take(5)
            ->get();
        return view('public.warta-detail', compact('warta', 'latest'));
    }
}
