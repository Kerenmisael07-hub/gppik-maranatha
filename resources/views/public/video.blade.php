@extends('layouts.app')

@section('content')
<section class="page-content">
    <h2 class="title" style="font-size: 32px; color: var(--blue-1); margin-bottom: 24px;">
        <i class="fas fa-video"></i> Galeri Video
    </h2>
    
    @if($videos->count() > 0)
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
            @foreach($videos as $video)
            <div class="hero-img galeri" style="cursor:pointer;position:relative" 
                 onclick="openVideoModal(
                     '{{ asset('storage/' . $video->video_path) }}', 
                     '{{ addslashes($video->title) }}', 
                     '{{ addslashes($video->description ?? '') }}', 
                     '{{ $video->created_at->format('d M Y') }}'
                 )">
                
                <!-- Video Thumbnail -->
                <div style="position:relative;width:100%;aspect-ratio:16/9">
                    @if($video->thumbnail_path)
                        <img src="{{ asset('storage/' . $video->thumbnail_path) }}" 
                             alt="{{ $video->title }}" 
                             style="width:100%;height:100%;object-fit:cover;border-radius:8px">
                    @else
                        <div style="width:100%;height:100%;background:linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);border-radius:8px;display:flex;align-items:center;justify-content:center">
                            <i class="fas fa-video" style="font-size:48px;color:#fff;opacity:0.5"></i>
                        </div>
                    @endif
                    
                    <!-- Play Button Overlay -->
                    <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);background:rgba(220,53,69,0.95);border-radius:50%;width:70px;height:70px;display:flex;align-items:center;justify-content:center;transition:all 0.3s ease;box-shadow:0 4px 12px rgba(220,53,69,0.4)">
                        <i class="fas fa-play" style="font-size:28px;color:#fff;margin-left:5px"></i>
                    </div>
                    
                    <!-- Duration Badge (jika ada) -->
                    <span style="position:absolute;bottom:12px;right:12px;background:rgba(0,0,0,0.8);color:#fff;padding:4px 8px;border-radius:4px;font-size:12px;font-weight:600">
                        <i class="fas fa-play-circle"></i> Video
                    </span>
                </div>
                
                <div style="text-align: center; padding: 16px; background: #fbfcfe;">
                    <p style="color: #102a43; font-weight: 600; margin: 0 0 6px 0; font-size: 16px;">
                        {{ $video->title }}
                    </p>
                    @if($video->description)
                    <p style="color: #6b7280; font-size: 14px; margin: 0 0 8px 0; line-height: 1.4;">
                        {{ Str::limit($video->description, 100) }}
                    </p>
                    @endif
                    <p style="color: #6b7280; font-size: 13px; margin: 0;">
                        <i class="far fa-calendar"></i> {{ $video->created_at->format('d M Y') }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div style="text-align:center;padding:60px 20px;background:#f8f9fa;border-radius:8px">
            <i class="fas fa-video" style="font-size:48px;color:#d1d5db;margin-bottom:16px"></i>
            <p style="color:#6b7280;font-size:16px">Belum ada video di galeri</p>
        </div>
    @endif
</section>

<!-- Modal untuk video -->
<div id="videoModal" style="display:none;position:fixed;z-index:9999;left:0;top:0;width:100%;height:100%;background:rgba(0,0,0,0.95);padding:20px">
    <span style="position:absolute;top:20px;right:40px;color:#fff;font-size:40px;font-weight:bold;cursor:pointer;z-index:10000" onclick="closeVideoModal()">&times;</span>
    <div style="display:flex;flex-direction:column;align-items:center;justify-content:center;height:100%;max-width:1200px;margin:0 auto">
        <!-- Video Player -->
        <div style="width:100%;max-width:900px;background:#000;border-radius:8px;overflow:hidden;box-shadow:0 8px 32px rgba(0,0,0,0.5)">
            <video id="modalVideo" controls autoplay style="width:100%;display:block">
                <source src="" type="video/mp4">
                Browser Anda tidak mendukung tag video.
            </video>
        </div>
        
        <!-- Video Info -->
        <div style="background:white;padding:24px;margin-top:20px;border-radius:8px;max-width:900px;width:100%;box-shadow:0 4px 12px rgba(0,0,0,0.1)">
            <h3 id="modalTitle" style="color:#003a8c;margin-bottom:8px;font-size:20px"></h3>
            <p id="modalDate" style="color:#6b7280;font-size:14px;margin-bottom:12px">
                <i class="far fa-calendar"></i> <span></span>
            </p>
            <p id="modalDescription" style="color:#334e68;line-height:1.6;font-size:15px"></p>
        </div>
    </div>
</div>

<script>
    function openVideoModal(videoSrc, title, description, date) {
        const modal = document.getElementById('videoModal');
        const modalVideo = document.getElementById('modalVideo');
        
        modal.style.display = 'block';
        document.getElementById('modalTitle').textContent = title;
        document.getElementById('modalDate').querySelector('span').textContent = date;
        document.getElementById('modalDescription').textContent = description;
        
        modalVideo.querySelector('source').src = videoSrc;
        modalVideo.load();
        modalVideo.play();
        
        document.body.style.overflow = 'hidden';
    }

    function closeVideoModal() {
        const modal = document.getElementById('videoModal');
        const modalVideo = document.getElementById('modalVideo');
        
        modal.style.display = 'none';
        modalVideo.pause();
        modalVideo.currentTime = 0;
        document.body.style.overflow = 'auto';
    }

    // Close modal dengan ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeVideoModal();
    });

    // Close modal saat klik di luar video
    document.getElementById('videoModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeVideoModal();
        }
    });
</script>

<style>
    .hero-img.galeri:hover .fa-play {
        transform: scale(1.1);
    }
    
    @media (max-width: 768px) {
        section.page-content > div {
            grid-template-columns: 1fr !important;
        }
    }
</style>
@endsection
