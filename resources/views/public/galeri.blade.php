@extends('layouts.app')

@section('content')
<section class="page-content">
    <h2 class="title" style="font-size: 32px; color: var(--blue-1); margin-bottom: 24px;">
        <i class="fas fa-images"></i> Galeri Foto
    </h2>
    
    @if($galleries->count() > 0)
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
            @foreach($galleries as $gallery)
            <div class="hero-img galeri" style="cursor:pointer;position:relative" 
                 onclick="openModal(
                     '{{ asset('storage/' . $gallery->image_path) }}', 
                     '{{ addslashes($gallery->title) }}', 
                     '{{ addslashes($gallery->description ?? '') }}', 
                     '{{ $gallery->created_at->format('d M Y') }}'
                 )">
                
                <!-- Image -->
                <img src="{{ asset('storage/' . $gallery->image_path) }}" 
                     alt="{{ $gallery->title }}" 
                     style="width: 100%; aspect-ratio: 1/1; object-fit: cover; border-radius: 8px;">
                
                <div style="text-align: center; padding: 12px; background: #fbfcfe;">
                    <p style="color: #102a43; font-weight: 500; margin: 0 0 4px 0;">
                        {{ $gallery->title }}
                    </p>
                    <p style="color: #6b7280; font-size: 13px; margin: 0;">
                        <i class="far fa-calendar"></i> {{ $gallery->created_at->format('d M Y') }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div style="text-align:center;padding:60px 20px;background:#f8f9fa;border-radius:8px">
            <i class="fas fa-images" style="font-size:48px;color:#d1d5db;margin-bottom:16px"></i>
            <p style="color:#6b7280;font-size:16px">Belum ada foto di galeri</p>
        </div>
    @endif
</section>

<!-- Modal untuk melihat foto besar -->
<div id="imageModal" style="display:none;position:fixed;z-index:9999;left:0;top:0;width:100%;height:100%;background:rgba(0,0,0,0.95);padding:20px" onclick="closeModal()">
    <span style="position:absolute;top:20px;right:40px;color:#fff;font-size:40px;font-weight:bold;cursor:pointer;z-index:10000" onclick="closeModal()">&times;</span>
    <div style="display:flex;flex-direction:column;align-items:center;justify-content:center;height:100%;max-width:1200px;margin:0 auto" onclick="event.stopPropagation()">
        <img id="modalImage" src="" style="max-width:100%;max-height:80vh;object-fit:contain;border-radius:8px;box-shadow:0 8px 32px rgba(0,0,0,0.5)">
        <div style="background:white;padding:20px;margin-top:20px;border-radius:8px;max-width:600px;width:100%;box-shadow:0 4px 12px rgba(0,0,0,0.1)">
            <h3 id="modalTitle" style="color:#003a8c;margin-bottom:4px"></h3>
            <p id="modalDate" style="color:#6b7280;font-size:14px;margin-bottom:12px">
                <i class="far fa-calendar"></i> <span></span>
            </p>
            <p id="modalDescription" style="color:#6b7280;line-height:1.6"></p>
        </div>
    </div>
</div>

<script>
    function openModal(imageSrc, title, description, date) {
        document.getElementById('imageModal').style.display = 'block';
        document.getElementById('modalImage').src = imageSrc;
        document.getElementById('modalTitle').textContent = title;
        document.getElementById('modalDate').querySelector('span').textContent = date;
        document.getElementById('modalDescription').textContent = description;
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        document.getElementById('imageModal').style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    // Close modal dengan ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeModal();
    });
</script>

<style>
    @media (max-width: 768px) {
        section.page-content > div {
            grid-template-columns: 1fr !important;
        }
    }
</style>
@endsection
