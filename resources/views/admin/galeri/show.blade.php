@extends('layouts.admin')

@section('content')
<div class="dashboard-module">
    <div style="margin-bottom:20px">
        <a href="{{ route('admin.galeri_foto') }}" class="action-button" style="background:#6c757d">
            <i class="fas fa-arrow-left"></i> Kembali ke Galeri
        </a>
    </div>

    <h3 style="margin-bottom:16px">{{ $gallery->title }}</h3>
    
    @if($gallery->isVideo())
        <!-- Video Player -->
        <div style="background:#000;border-radius:8px;overflow:hidden;max-width:800px">
            <video controls style="width:100%;height:auto;display:block">
                <source src="{{ asset('storage/'.$gallery->video_path) }}" type="video/mp4">
                Browser Anda tidak mendukung tag video.
            </video>
        </div>
        <span style="display:inline-block;margin-top:12px;background:#dc3545;color:#fff;padding:6px 12px;border-radius:4px;font-size:13px;font-weight:600">
            <i class="fas fa-video"></i> VIDEO
        </span>
    @else
        <!-- Image -->
        <img src="{{ asset('storage/'.$gallery->image_path) }}" 
             alt="{{ $gallery->title }}" 
             style="width:100%;max-width:800px;height:auto;border-radius:8px;box-shadow:0 4px 6px rgba(0,0,0,0.1)">
        <span style="display:inline-block;margin-top:12px;background:#0066cc;color:#fff;padding:6px 12px;border-radius:4px;font-size:13px;font-weight:600">
            <i class="fas fa-image"></i> FOTO
        </span>
    @endif
    
    @if($gallery->description)
    <div style="margin-top:20px;padding:16px;background:#f8f9fa;border-radius:8px;border-left:4px solid #0066cc">
        <h4 style="margin:0 0 8px 0;color:#003a8c">Deskripsi:</h4>
        <p style="margin:0;color:#334e68;line-height:1.6">{{ $gallery->description }}</p>
    </div>
    @endif

    <div style="margin-top:20px;padding:12px;background:#f0f4ff;border-radius:6px;font-size:13px;color:#6b7280">
        <i class="fas fa-info-circle"></i> Ditambahkan pada: {{ $gallery->created_at->format('d M Y, H:i') }}
    </div>
</div>
@endsection
