@extends('layouts.admin')

@section('content')
    <div class="dashboard-module">
        <div style="margin-bottom:24px;">
            <h2 style="margin:0 0 8px 0;">Tambah Nyanyian Baru</h2>
            <a href="{{ route('admin.nyanyian.index') }}" style="color:#0066cc;text-decoration:none;">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar
            </a>
        </div>

        @if($errors->any())
            <div class="box" style="background:#f8d7da;color:#721c24;border:1px solid #f5c6cb;margin-bottom:20px;">
                <strong><i class="fas fa-exclamation-triangle"></i> Terdapat kesalahan:</strong>
                <ul style="margin:8px 0 0 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="post" action="{{ route('admin.nyanyian.store') }}">
            @csrf
            
            <div class="box" style="margin-bottom:20px;">
                <h3 style="margin-top:0;">Informasi Dasar</h3>
                
                <div class="mb-2">
                    <label style="display:block;margin-bottom:6px;font-weight:600;">
                        Nomor Lagu <span style="color:red;">*</span>
                    </label>
                    <input type="text" 
                           name="nomor_lagu" 
                           value="{{ old('nomor_lagu') }}" 
                           placeholder="Contoh: KJ 300, PKJ 125, NKB 50"
                           required 
                           style="width:100%;padding:10px;border:1px solid #e0e6f1;border-radius:6px;">
                    <small style="color:#6c757d;">Format: [Sumber] [Nomor], contoh: KJ 300</small>
                    @error('nomor_lagu')<div style="color:#dc3545;margin-top:4px;">{{ $message }}</div>@enderror
                </div>

                <div class="mb-2">
                    <label style="display:block;margin-bottom:6px;font-weight:600;">
                        Judul Lagu <span style="color:red;">*</span>
                    </label>
                    <input type="text" 
                           name="judul_lagu" 
                           value="{{ old('judul_lagu') }}" 
                           placeholder="Masukkan judul lagu"
                           required 
                           style="width:100%;padding:10px;border:1px solid #e0e6f1;border-radius:6px;">
                    @error('judul_lagu')<div style="color:#dc3545;margin-top:4px;">{{ $message }}</div>@enderror
                </div>

                <div class="mb-2">
                    <label style="display:block;margin-bottom:6px;font-weight:600;">Sumber Buku</label>
                    <input type="text" 
                           name="sumber_buku" 
                           value="NHYK (Nyanyian Hidup Yang Kekal)" 
                           readonly
                           style="width:100%;padding:10px;border:1px solid #e0e6f1;border-radius:6px;background:#f8f9fa;">
                </div>
            </div>

            <div class="box" style="margin-bottom:20px;">
                <h3 style="margin-top:0;">Lirik Lagu</h3>
                
                <div class="mb-2">
                    <label style="display:block;margin-bottom:6px;font-weight:600;">
                        Lirik <span style="color:red;">*</span>
                    </label>
                    <textarea name="lirik" 
                              rows="15" 
                              required 
                              placeholder="Masukkan lirik lagu di sini...&#10;&#10;Gunakan Enter untuk membuat baris baru.&#10;Pisahkan bait dengan baris kosong."
                              style="width:100%;max-height:400px;padding:12px;border:1px solid #e0e6f1;border-radius:6px;font-family:monospace;line-height:1.6;resize:vertical;overflow-y:auto;">{{ old('lirik') }}</textarea>
                    <small style="color:#6c757d;">
                        <i class="fas fa-info-circle"></i> Tip: Tekan Enter dua kali untuk memisahkan antar bait
                    </small>
                    @error('lirik')<div style="color:#dc3545;margin-top:4px;">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="box" style="margin-bottom:20px;">
                <h3 style="margin-top:0;">Status Publikasi</h3>
                
                <div class="mb-2">
                    <label style="display:block;margin-bottom:6px;font-weight:600;">
                        Status <span style="color:red;">*</span>
                    </label>
                    <div style="display:flex;gap:16px;">
                        <label style="display:flex;align-items:center;gap:6px;cursor:pointer;">
                            <input type="radio" name="status" value="1" {{ old('status', '1') == '1' ? 'checked' : '' }} required>
                            <span><i class="fas fa-check-circle" style="color:#28a745;"></i> Aktif (Tampil di halaman publik)</span>
                        </label>
                        <label style="display:flex;align-items:center;gap:6px;cursor:pointer;">
                            <input type="radio" name="status" value="0" {{ old('status') == '0' ? 'checked' : '' }}>
                            <span><i class="fas fa-times-circle" style="color:#6c757d;"></i> Nonaktif/Draft (Tidak tampil)</span>
                        </label>
                    </div>
                    @error('status')<div style="color:#dc3545;margin-top:4px;">{{ $message }}</div>@enderror
                </div>
            </div>

            <div style="display:flex;gap:12px;justify-content:flex-end;margin-top:24px;margin-bottom:40px;">
                <a href="{{ route('admin.nyanyian.index') }}" 
                   class="action-button" 
                   style="background:#6c757d;">
                    <i class="fas fa-times"></i> Batal
                </a>
                <button class="action-button" type="submit" style="background:#28a745;">
                    <i class="fas fa-save"></i> Simpan Lagu
                </button>
            </div>
        </form>
    </div>
@endsection
