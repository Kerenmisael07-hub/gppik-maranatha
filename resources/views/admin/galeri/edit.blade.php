@extends('layouts.admin')

@section('content')
<div class="dashboard-module">
    <h2>Edit Foto Galeri</h2>
    
    @if($errors->any())
    <div class="box" style="background:#f8d7da;color:#721c24;padding:12px;margin:16px 0">
        <ul style="margin:0;padding-left:20px">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="post" action="{{ route('admin.galeri_foto.update',$gallery) }}" enctype="multipart/form-data">
        @csrf 
        @method('PUT')
        
        <div class="box" style="margin-bottom:20px">
            <div class="mb-2">
                <label style="font-weight:600;display:block;margin-bottom:6px">Judul Foto *</label>
                <input type="text" 
                       name="title" 
                       value="{{ old('title', $gallery->title) }}"
                       required
                       style="width:100%;padding:10px;border-radius:6px;border:1px solid #e0e6f1">
            </div>

            <div class="mb-2">
                <label style="font-weight:600;display:block;margin-bottom:6px">Gambar Saat Ini</label>
                <img src="{{ asset('storage/' . $gallery->image_path) }}" 
                     alt="{{ $gallery->title }}" 
                     style="max-width:300px;border-radius:8px;margin-bottom:12px">
                
                <label style="font-weight:600;display:block;margin-bottom:6px">Upload Gambar Baru (Opsional)</label>
                <input type="file" 
                       name="image" 
                       accept="image/*"
                       style="width:100%;padding:10px;border-radius:6px;border:1px solid #e0e6f1">
                <p style="font-size:13px;color:#6c757d;margin-top:4px">Kosongkan jika tidak ingin mengubah gambar</p>
            </div>

            <div class="mb-2">
                <label style="font-weight:600;display:block;margin-bottom:6px">Deskripsi (Opsional)</label>
                <textarea name="description" 
                          rows="4" 
                          style="width:100%;padding:10px;border-radius:6px;border:1px solid #e0e6f1">{{ old('description', $gallery->description) }}</textarea>
            </div>
        </div>

        <div style="display:flex;gap:8px">
            <button type="submit" class="action-button" style="background:#28a745">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
            <a href="{{ route('admin.galeri_foto') }}" class="action-button" style="background:#6c757d">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </form>
</div>
@endsection
