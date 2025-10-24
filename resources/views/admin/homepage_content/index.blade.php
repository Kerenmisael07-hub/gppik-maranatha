@extends('layouts.admin')

@section('content')
<div class="dashboard-module">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px">
        <h2 style="font-size:24px;font-weight:700;color:#0b132b">🏠 Konten Beranda</h2>
        <a href="{{ route('admin.homepage_content.create') }}" 
           style="background:#0066cc;color:#fff;padding:10px 20px;border-radius:6px;text-decoration:none;display:inline-flex;align-items:center;gap:8px">
            <i class="fas fa-plus"></i> Tambah Konten
        </a>
    </div>

    @if(session('success'))
    <div style="background:#d4edda;color:#155724;padding:12px 16px;border-radius:6px;margin-bottom:20px;border:1px solid #c3e6cb">
        ✓ {{ session('success') }}
    </div>
    @endif

    @if($contents->count() > 0)
    <div style="background:#fff;border-radius:8px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,0.05)">
        <table style="width:100%;border-collapse:collapse">
            <thead style="background:#f8f9fa">
                <tr>
                    <th style="padding:14px;text-align:left;font-weight:600;color:#102a43;border-bottom:2px solid #e0e6f1">Urutan</th>
                    <th style="padding:14px;text-align:left;font-weight:600;color:#102a43;border-bottom:2px solid #e0e6f1">Tipe</th>
                    <th style="padding:14px;text-align:left;font-weight:600;color:#102a43;border-bottom:2px solid #e0e6f1">Judul</th>
                    <th style="padding:14px;text-align:left;font-weight:600;color:#102a43;border-bottom:2px solid #e0e6f1">Preview</th>
                    <th style="padding:14px;text-align:center;font-weight:600;color:#102a43;border-bottom:2px solid #e0e6f1">Status</th>
                    <th style="padding:14px;text-align:center;font-weight:600;color:#102a43;border-bottom:2px solid #e0e6f1">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contents as $content)
                <tr style="border-bottom:1px solid #f0f4ff">
                    <td style="padding:14px;color:#334e68">{{ $content->order }}</td>
                    <td style="padding:14px">
                        <span style="background:{{ 
                            $content->type == 'hero' ? '#e3f2fd' : 
                            ($content->type == 'image' ? '#fce4ec' : '#f3e5f5')
                        }};color:{{
                            $content->type == 'hero' ? '#1565c0' : 
                            ($content->type == 'image' ? '#c2185b' : '#6a1b9a')
                        }};padding:4px 10px;border-radius:4px;font-size:12px;font-weight:600">
                            {{ strtoupper($content->type) }}
                        </span>
                    </td>
                    <td style="padding:14px;color:#334e68;font-weight:500">
                        {{ $content->title ?? '-' }}
                    </td>
                    <td style="padding:14px;color:#6b7280;font-size:13px">
                        @if($content->image_path)
                            <img src="{{ asset('storage/' . $content->image_path) }}" 
                                 alt="Preview" 
                                 style="width:60px;height:40px;object-fit:cover;border-radius:4px">
                        @elseif($content->content)
                            {{ Str::limit($content->content, 50) }}
                        @else
                            <span style="color:#9ca3af">-</span>
                        @endif
                    </td>
                    <td style="padding:14px;text-align:center">
                        @if($content->is_active)
                            <span style="background:#d4edda;color:#155724;padding:4px 10px;border-radius:4px;font-size:12px;font-weight:600">
                                ● Aktif
                            </span>
                        @else
                            <span style="background:#f8d7da;color:#721c24;padding:4px 10px;border-radius:4px;font-size:12px;font-weight:600">
                                ○ Nonaktif
                            </span>
                        @endif
                    </td>
                    <td style="padding:14px;text-align:center">
                        <div style="display:inline-flex;gap:6px">
                            <a href="{{ route('admin.homepage_content.edit', $content) }}" 
                               style="background:#0066cc;color:#fff;padding:6px 12px;border-radius:4px;text-decoration:none;font-size:13px"
                               title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.homepage_content.destroy', $content) }}" 
                                  method="POST" 
                                  style="display:inline"
                                  onsubmit="return confirm('Yakin ingin menghapus konten ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        style="background:#dc3545;color:#fff;padding:6px 12px;border-radius:4px;border:none;cursor:pointer;font-size:13px"
                                        title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div style="background:#fff;border-radius:8px;padding:40px;text-align:center">
        <i class="fas fa-inbox" style="font-size:48px;color:#cbd5e0;margin-bottom:16px"></i>
        <p style="color:#6b7280;font-size:16px;margin-bottom:20px">Belum ada konten beranda.</p>
        <a href="{{ route('admin.homepage_content.create') }}" 
           style="background:#0066cc;color:#fff;padding:10px 20px;border-radius:6px;text-decoration:none;display:inline-flex;align-items:center;gap:8px">
            <i class="fas fa-plus"></i> Tambah Konten Pertama
        </a>
    </div>
    @endif
</div>
@endsection
