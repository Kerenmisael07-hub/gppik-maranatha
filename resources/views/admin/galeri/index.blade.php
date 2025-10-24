@extends('layouts.admin')

@section('content')
<div class="dashboard-module">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px">
        <h2>Galeri Foto & Video</h2>
        <a href="{{ route('admin.galeri_foto.create') }}" class="action-button" style="background:#28a745">
            <i class="fas fa-plus"></i> Unggah Media
        </a>
    </div>

    @if(session('success'))
    <div class="box" style="background:#d4edda;color:#155724;padding:12px;margin-bottom:16px">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    <div style="margin-top:20px;display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:16px">
        @forelse($items as $it)
            <div class="box" style="padding:0;overflow:hidden;position:relative">
                @if($it->isVideo())
                    <!-- Video Thumbnail with Play Icon -->
                    <div style="position:relative;width:100%;height:200px;background:#000">
                        @if($it->thumbnail_path)
                            <img src="{{ asset('storage/'.$it->thumbnail_path) }}" 
                                 alt="{{ $it->title }}" 
                                 style="width:100%;height:100%;object-fit:cover">
                        @else
                            <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:#1a1a1a">
                                <i class="fas fa-video" style="font-size:48px;color:#fff;opacity:0.5"></i>
                            </div>
                        @endif
                        <!-- Play Icon Overlay -->
                        <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);background:rgba(0,0,0,0.7);border-radius:50%;width:60px;height:60px;display:flex;align-items:center;justify-content:center">
                            <i class="fas fa-play" style="font-size:24px;color:#fff;margin-left:4px"></i>
                        </div>
                        <!-- Video Badge -->
                        <span style="position:absolute;top:8px;right:8px;background:#dc3545;color:#fff;padding:4px 8px;border-radius:4px;font-size:11px;font-weight:600">
                            <i class="fas fa-video"></i> VIDEO
                        </span>
                    </div>
                @else
                    <!-- Image -->
                    <img src="{{ asset('storage/'.$it->image_path) }}" 
                         alt="{{ $it->title }}" 
                         style="width:100%;height:200px;object-fit:cover">
                    <!-- Image Badge -->
                    <span style="position:absolute;top:8px;right:8px;background:#0066cc;color:#fff;padding:4px 8px;border-radius:4px;font-size:11px;font-weight:600">
                        <i class="fas fa-image"></i> FOTO
                    </span>
                @endif
                
                <div style="padding:12px">
                    <h4 style="margin:0 0 8px 0;color:#003a8c">{{ $it->title }}</h4>
                    @if($it->description)
                    <p style="font-size:13px;color:#6c757d;margin-bottom:12px">{{ Str::limit($it->description, 80) }}</p>
                    @endif
                    <div style="display:flex;gap:6px">
                        <a href="{{ route('admin.galeri_foto.show',$it) }}" 
                           class="action-button" 
                           style="background:#6c757d;font-size:13px;padding:6px 10px">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.galeri_foto.edit',$it) }}" 
                           class="action-button" 
                           style="background:#0dcaf0;color:#000;font-size:13px;padding:6px 10px">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.galeri_foto.destroy',$it) }}" method="post" style="display:inline">
                            @csrf 
                            @method('DELETE')
                            <button class="action-button" 
                                    style="background:#dc3545;font-size:13px;padding:6px 10px" 
                                    onclick="return confirm('Hapus {{ $it->isVideo() ? 'video' : 'foto' }} ini?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div style="grid-column:1/-1;text-align:center;padding:60px 20px;background:#f8f9fa;border-radius:8px">
                <i class="fas fa-photo-video" style="font-size:48px;color:#d1d5db;margin-bottom:16px"></i>
                <p style="color:#6b7280;font-size:16px">Belum ada foto atau video di galeri</p>
                <a href="{{ route('admin.galeri_foto.create') }}" class="action-button" style="background:#28a745;margin-top:12px">
                    <i class="fas fa-plus"></i> Unggah Media Pertama
                </a>
            </div>
        @endforelse
    </div>
    
    @if($items->hasPages())
    <div style="margin-top:20px">{{ $items->links() }}</div>
    @endif
</div>
@endsection
