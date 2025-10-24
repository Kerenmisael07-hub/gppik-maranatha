<x-layouts.app :title="($nyanyian->title ?? 'Nyanyian').' - GPPIK'">
    <section class="page-content song-detail">
        <div class="breadcrumb" style="font-size:14px;margin-bottom:20px;color:var(--muted)">
            <a href="{{ route('home') }}" style="color:var(--blue-2);font-weight:600;text-decoration:none;">Home</a> /
            <a href="{{ route('nyanyian.index') }}" style="color:var(--blue-2);font-weight:600;text-decoration:none;">Daftar Nyanyian</a> /
            <strong>{{ $nyanyian->title }}</strong>
        </div>
        <h1 style="color:var(--blue-1);font-size:32px;margin-bottom:10px;">{{ $nyanyian->title }}</h1>
        <div class="song-info" style="color:var(--muted);font-size:14px;margin-bottom:20px;border-bottom:1px solid #eef3fb;padding-bottom:10px;">
            Kategori: {{ $nyanyian->category ?? '-' }} | Kunci: {{ $nyanyian->music_key ?? '-' }} | Hal: {{ $nyanyian->page ?? '-' }}
        </div>
        <pre class="song-lyrics" style="white-space:pre-wrap;line-height:2.0;font-size:16px;color:#334e68;">{{ $nyanyian->lyrics }}</pre>
        <a href="{{ route('nyanyian.index') }}" class="action-button" style="display:inline-block;margin-top:30px;background-color:var(--blue-2);color:#fff;padding:10px 15px;border-radius:6px;text-decoration:none;">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Lagu
        </a>
    </section>
    <footer style="margin-top:60px;">
        <div style="text-align:center;padding:20px;background-color:#0b132b;color:#fff;">
            <p>© {{ date('Y') }} GPPIK Maranatha Antan. All rights reserved.</p>
        </div>
    </footer>
</x-layouts.app>
