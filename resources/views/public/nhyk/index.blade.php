@extends('layouts.app')

@section('content')
    <section class="page-content">
        <div class="breadcrumb" style="font-size:14px;margin-bottom:20px;color:var(--muted)">
            <a href="{{ route('home') }}" style="color:var(--blue-2);font-weight:600;text-decoration:none;">Home</a> / <strong>**Daftar Nyanyian**</strong>
        </div>

        <div class="nhyk-layout" style="display:grid;grid-template-columns:3fr 1fr;gap:30px;">
            <!-- Main Content Area -->
            <div class="nhyk-main" id="nyanyian-list">
                @forelse($nyanyians as $song)
                    <div class="nhyk-item" style="background:#fff;border-radius:8px;padding:20px;margin-bottom:15px;box-shadow:0 4px 15px rgba(0, 58, 140, 0.08);border-left:5px solid var(--blue-2);transition:all 0.3s ease;">
                        <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px;">
                            <span style="background:var(--blue-2);color:#fff;padding:4px 10px;border-radius:4px;font-size:12px;font-weight:700;">
                                {{ $song->nomor_lagu }}
                            </span>
                        </div>
                        <a href="{{ route('nyanyian.show', $song) }}" style="text-decoration:none;display:block;">
                            <h4 style="color:var(--blue-1);margin-bottom:6px;font-size:20px;font-weight:700;transition:color 0.2s;">
                                {{ $song->judul_lagu }}
                            </h4>
                        </a>
                        <p style="color:var(--muted);font-size:14px;margin:0;">
                            @if($song->sumber_buku)
                                <i class="fas fa-book"></i> {{ $song->sumber_buku }}
                            @endif
                        </p>
                    </div>
                @empty
                    <div style="text-align:center;padding:50px;background:var(--gray-light);border-radius:8px;">
                        <i class="fas fa-music" style="font-size:48px;color:var(--blue-2);margin-bottom:15px;"></i>
                        <h4 style="color:var(--dark);margin-bottom:8px;">Belum Ada Nyanyian</h4>
                        <p style="color:var(--muted);">Daftar lagu akan muncul di sini setelah ditambahkan melalui Dashboard Admin.</p>
                    </div>
                @endforelse

                <!-- Pagination -->
                @if($nyanyians->hasPages())
                <div style="margin-top:24px;">
                    {{ $nyanyians->links('vendor.pagination.custom') }}
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="nhyk-sidebar">
                <!-- Search Box -->
                <div class="box" style="margin-bottom:20px;">
                    <div class="sidebar-title" style="color:var(--dark);font-size:16px;font-weight:700;border-left:5px solid var(--blue-2);padding-left:10px;margin-bottom:15px;text-transform:uppercase;">
                        <i class="fas fa-search"></i> CARI NYANYIAN
                    </div>
                    <form method="get" id="search-form">
                        <input type="text" 
                               name="search" 
                               id="search-input"
                               value="{{ request('search') }}" 
                               placeholder="Masukkan judul, nomor, atau lirik..." 
                               style="width:100%;padding:12px;border:1px solid #e0e6f1;border-radius:6px;margin-bottom:10px;">
                        <button type="submit" 
                                style="width:100%;padding:12px;background:var(--blue-2);color:#fff;border:none;border-radius:6px;cursor:pointer;font-weight:600;">
                            <i class="fas fa-search"></i> Cari Lagu
                        </button>
                    </form>
                </div>

                <!-- Reset All Filters -->
                @if(request('search'))
                <div style="margin-top:20px;">
                    <a href="{{ route('nyanyian.index') }}" 
                       style="display:block;text-align:center;padding:12px;background:#6c757d;color:#fff;border-radius:6px;text-decoration:none;font-weight:600;">
                        <i class="fas fa-redo"></i> Reset Filter
                    </a>
                </div>
                @endif
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        // Optional: AJAX untuk pencarian real-time (coming soon)
        // document.getElementById('search-input').addEventListener('input', function() {
        //     // Implement AJAX search here
        // });
    </script>
    <style>
        .nhyk-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 58, 140, 0.12) !important;
        }
        .nhyk-item a h4:hover {
            color: var(--blue-2) !important;
            text-decoration: underline;
        }
    </style>
    @endpush
@endsection

