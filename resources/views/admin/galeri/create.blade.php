@extends('layouts.admin')

@section('content')
<div class="dashboard-module">
    <h2>Tambah Media Galeri</h2>
    
    @if($errors->any())
    <div class="box" style="background:#f8d7da;color:#721c24;padding:12px;margin:16px 0">
        <ul style="margin:0;padding-left:20px">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="post" action="{{ route('admin.galeri_foto.store') }}" enctype="multipart/form-data" id="galleryForm">
        @csrf
        
        <div class="box" style="margin-bottom:20px">
            <!-- Media Type Selection -->
            <div class="mb-2">
                <label style="font-weight:600;display:block;margin-bottom:6px">Tipe Media *</label>
                <div style="display:flex;gap:16px;margin-bottom:12px">
                    <label style="display:flex;align-items:center;gap:8px;cursor:pointer">
                        <input type="radio" name="media_type" value="image" checked onclick="toggleMediaType('image')" style="width:18px;height:18px">
                        <span><i class="fas fa-image" style="color:#0066cc"></i> Foto/Gambar</span>
                    </label>
                    <label style="display:flex;align-items:center;gap:8px;cursor:pointer">
                        <input type="radio" name="media_type" value="video" onclick="toggleMediaType('video')" style="width:18px;height:18px">
                        <span><i class="fas fa-video" style="color:#dc3545"></i> Video</span>
                    </label>
                </div>
            </div>

            <div class="mb-2">
                <label style="font-weight:600;display:block;margin-bottom:6px">Judul *</label>
                <input type="text" 
                       name="title" 
                       value="{{ old('title') }}"
                       placeholder="Contoh: Perayaan Natal 2024" 
                       required
                       style="width:100%;padding:10px;border-radius:6px;border:1px solid #e0e6f1">
            </div>

            <!-- Image Upload (shown when image is selected) -->
            <div class="mb-2" id="imageUpload">
                <label style="font-weight:600;display:block;margin-bottom:6px">Upload Gambar *</label>
                <input type="file" 
                       name="image" 
                       accept="image/jpeg,image/png,image/jpg" 
                       id="imageInput"
                       style="width:100%;padding:10px;border-radius:6px;border:1px solid #e0e6f1">
                <p style="font-size:13px;color:#6c757d;margin-top:4px">Format: JPG, PNG. Maksimal 2MB</p>
            </div>

            <!-- Video Upload (hidden by default) -->
            <div class="mb-2" id="videoUpload" style="display:none">
                <label style="font-weight:600;display:block;margin-bottom:6px">Upload Video *</label>
                <input type="file" 
                       name="video" 
                       accept="video/mp4,video/avi,video/mov,video/wmv" 
                       id="videoInput"
                       style="width:100%;padding:10px;border-radius:6px;border:1px solid #e0e6f1">
                <p style="font-size:13px;color:#6c757d;margin-top:4px">Format: MP4, AVI, MOV, WMV. Maksimal 50MB</p>
            </div>

            <!-- Thumbnail Upload for Video -->
            <div class="mb-2" id="thumbnailUpload" style="display:none">
                <label style="font-weight:600;display:block;margin-bottom:6px">Upload Thumbnail (Opsional)</label>
                <input type="file" 
                       name="thumbnail" 
                       accept="image/jpeg,image/png,image/jpg"
                       style="width:100%;padding:10px;border-radius:6px;border:1px solid #e0e6f1">
                <p style="font-size:13px;color:#6c757d;margin-top:4px">Thumbnail akan ditampilkan di galeri. Jika tidak diupload, akan menggunakan gambar default.</p>
            </div>

            <div class="mb-2">
                <label style="font-weight:600;display:block;margin-bottom:6px">Deskripsi (Opsional)</label>
                <textarea name="description" 
                          rows="4" 
                          placeholder="Tulis deskripsi singkat..."
                          style="width:100%;padding:10px;border-radius:6px;border:1px solid #e0e6f1">{{ old('description') }}</textarea>
            </div>
        </div>

        <div style="display:flex;gap:8px">
            <button type="submit" class="action-button" style="background:#28a745">
                <i class="fas fa-upload"></i> <span id="submitText">Unggah Media</span>
            </button>
            <a href="{{ route('admin.galeri_foto') }}" class="action-button" style="background:#6c757d">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </form>
</div>

<script>
function toggleMediaType(type) {
    const imageUpload = document.getElementById('imageUpload');
    const videoUpload = document.getElementById('videoUpload');
    const thumbnailUpload = document.getElementById('thumbnailUpload');
    const imageInput = document.getElementById('imageInput');
    const videoInput = document.getElementById('videoInput');
    const submitText = document.getElementById('submitText');
    
    if (type === 'image') {
        imageUpload.style.display = 'block';
        videoUpload.style.display = 'none';
        thumbnailUpload.style.display = 'none';
        imageInput.setAttribute('required', 'required');
        videoInput.removeAttribute('required');
        submitText.textContent = 'Unggah Foto';
    } else {
        imageUpload.style.display = 'none';
        videoUpload.style.display = 'block';
        thumbnailUpload.style.display = 'block';
        imageInput.removeAttribute('required');
        videoInput.setAttribute('required', 'required');
        submitText.textContent = 'Unggah Video';
    }
}
</script>
@endsection
