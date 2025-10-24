@extends('layouts.admin')

@section('content')
    <div class="dashboard-module">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
            <h2 style="margin:0;">Daftar Nyanyian (NHYK)</h2>
            <a class="action-button" href="{{ route('admin.nyanyian.create') }}" style="background:#28a745;">
                <i class="fas fa-plus"></i> Tambah Nyanyian Baru
            </a>
        </div>

        <!-- Filter dan Search -->
        <div class="box" style="margin-bottom:20px;">
            <form method="get" style="display:grid;grid-template-columns:2fr 1fr 1fr;gap:12px;">
                <div>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Cari nomor, judul, atau lirik..." 
                           style="width:100%;padding:10px;border:1px solid #e0e6f1;border-radius:6px;">
                </div>
                <div>
                    <select name="status" style="width:100%;padding:10px;border:1px solid #e0e6f1;border-radius:6px;">
                        <option value="">Semua Status</option>
                        <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Nonaktif/Draft</option>
                    </select>
                </div>
                <div style="display:flex;gap:8px;">
                    <button class="action-button" type="submit" style="flex:1;">
                        <i class="fas fa-search"></i> Filter
                    </button>
                    <a href="{{ route('admin.nyanyian.index') }}" class="action-button" style="flex:1;background:#6c757d;text-align:center;">
                        <i class="fas fa-redo"></i> Reset
                    </a>
                </div>
            </form>
        </div>

        @if(session('success'))
            <div class="box" style="background:#d4edda;color:#155724;border:1px solid #c3e6cb;margin-bottom:20px;">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <!-- Tabel Data -->
        <div style="overflow-x:auto;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width:100px;">Nomor Lagu</th>
                        <th>Judul Lagu</th>
                        <th style="width:120px;">Sumber Buku</th>
                        <th style="width:100px;">Status</th>
                        <th style="width:120px;">Terakhir Update</th>
                        <th style="width:150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($nyanyians as $song)
                    <tr>
                        <td><strong>{{ $song->nomor_lagu }}</strong></td>
                        <td>{{ $song->judul_lagu }}</td>
                        <td>{{ $song->sumber_buku ?? '-' }}</td>
                        <td>
                            @if($song->status)
                                <span style="background:#28a745;color:white;padding:4px 8px;border-radius:4px;font-size:12px;">
                                    <i class="fas fa-check"></i> Aktif
                                </span>
                            @else
                                <span style="background:#6c757d;color:white;padding:4px 8px;border-radius:4px;font-size:12px;">
                                    <i class="fas fa-times"></i> Draft
                                </span>
                            @endif
                        </td>
                        <td>{{ $song->updated_at->format('d M Y') }}</td>
                        <td>
                            <div style="display:flex;gap:4px;">
                                <a href="{{ route('admin.nyanyian.edit', $song) }}" 
                                   class="action-button" 
                                   style="background:#ffc107;color:#000;padding:6px 10px;"
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.nyanyian.destroy', $song) }}" 
                                      method="post" 
                                      style="display:inline" 
                                      onsubmit="return confirm('Yakin ingin menghapus lagu: {{ $song->judul_lagu }}?')">
                                    @csrf @method('DELETE')
                                    <button class="action-button" 
                                            style="background:#dc3545;padding:6px 10px;"
                                            title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align:center;padding:40px;">
                            <i class="fas fa-music" style="font-size:48px;color:#ccc;margin-bottom:12px;"></i>
                            <p style="color:#6c757d;">Belum ada lagu yang ditambahkan.</p>
                            <a href="{{ route('admin.nyanyian.create') }}" class="action-button" style="margin-top:12px;">
                                <i class="fas fa-plus"></i> Tambah Lagu Pertama
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($nyanyians->hasPages())
        <div style="margin-top:20px;display:flex;justify-content:center;">
            {{ $nyanyians->links() }}
        </div>
        @endif

        <!-- Info Summary -->
        <div style="margin-top:12px;text-align:center;color:#6c757d;font-size:14px;">
            Menampilkan {{ $nyanyians->firstItem() ?? 0 }} - {{ $nyanyians->lastItem() ?? 0 }} 
            dari {{ $nyanyians->total() }} lagu
        </div>
    </div>
@endsection
