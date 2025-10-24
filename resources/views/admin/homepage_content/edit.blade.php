@extends('layouts.admin')

@section('content')
<div class="dashboard-module">
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:24px">
        <a href="{{ route('admin.homepage_content.index') }}" 
           style="color:#6b7280;text-decoration:none;display:inline-flex;align-items:center;gap:6px">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <h2 style="font-size:24px;font-weight:700;color:#0b132b">✏️ Edit Konten Beranda</h2>
    </div>

    @if($errors->any())
    <div style="background:#f8d7da;color:#721c24;padding:12px 16px;border-radius:6px;margin-bottom:20px;border:1px solid #f5c6cb">
        <strong>Terdapat kesalahan:</strong>
        <ul style="margin:8px 0 0 20px">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.homepage_content.update', $homepageContent) }}" method="POST" enctype="multipart/form-data" 
          style="background:#fff;border-radius:8px;padding:24px;box-shadow:0 2px 8px rgba(0,0,0,0.05)">
        @csrf
        @method('PUT')

        <div style="display:grid;gap:20px">
            <!-- Tipe Konten -->
            <div>
                <label style="display:block;font-weight:600;margin-bottom:8px;color:#102a43">
                    Tipe Konten <span style="color:#dc3545">*</span>
                </label>
                <select name="type" required style="width:100%;padding:10px;border:1px solid #e0e6f1;border-radius:6px;font-size:14px">
                    <option value="">-- Pilih Tipe --</option>
                    <option value="hero" {{ old('type', $homepageContent->type) == 'hero' ? 'selected' : '' }}>Hero (Bagian Utama)</option>
                    <option value="text" {{ old('type', $homepageContent->type) == 'text' ? 'selected' : '' }}>Text / Paragraf</option>
                    <option value="image" {{ old('type', $homepageContent->type) == 'image' ? 'selected' : '' }}>Image / Foto</option>
                </select>
            </div>

            <!-- Judul -->
            <div>
                <label style="display:block;font-weight:600;margin-bottom:8px;color:#102a43">
                    Judul / Heading
                </label>
                <input type="text" 
                       name="title" 
                       value="{{ old('title', $homepageContent->title) }}"
                       placeholder="Contoh: Selamat Datang di GPPIK Maranatha"
                       style="width:100%;padding:10px;border:1px solid #e0e6f1;border-radius:6px;font-size:14px">
            </div>

            <!-- Konten / Deskripsi -->
            <div>
                <label style="display:block;font-weight:600;margin-bottom:8px;color:#102a43">
                    Konten / Deskripsi
                </label>
                <textarea name="content" 
                          id="contentEditor"
                          rows="10"
                          placeholder="Tulis konten atau deskripsi di sini..."
                          style="width:100%;padding:10px;border:1px solid #e0e6f1;border-radius:6px;font-size:14px;line-height:1.6">{{ old('content', $homepageContent->content) }}</textarea>
                <small style="color:#6b7280;margin-top:4px;display:block">
                    💡 Gunakan toolbar untuk format teks: <strong>Bold</strong>, <em>Italic</em>, Bullet Points, dll.
                </small>
            </div>

            <!-- Upload Gambar -->
            <div style="border:1px solid #e0e6f1;border-radius:8px;padding:16px;background:#f9fafb">
                <label style="display:block;font-weight:600;margin-bottom:8px;color:#102a43">
                    Upload Gambar / Foto
                </label>
                
                <!-- Posisi Gambar -->
                <div style="margin-bottom:12px">
                    <label style="display:block;font-weight:500;margin-bottom:6px;color:#374151;font-size:14px">
                        Posisi Gambar
                    </label>
                    <div style="display:flex;gap:16px">
                        <label style="display:flex;align-items:center;gap:8px;cursor:pointer">
                            <input type="radio" name="image_position" value="left" 
                                   {{ old('image_position', $homepageContent->image_position) == 'left' ? 'checked' : '' }}
                                   style="width:16px;height:16px">
                            <span>Kiri</span>
                        </label>
                        <label style="display:flex;align-items:center;gap:8px;cursor:pointer">
                            <input type="radio" name="image_position" value="right" 
                                   {{ old('image_position', $homepageContent->image_position ?? 'right') == 'right' ? 'checked' : '' }}
                                   style="width:16px;height:16px">
                            <span>Kanan</span>
                        </label>
                    </div>
                </div>
                
                <!-- Current Single Image -->
                @if($homepageContent->image_path)
                <div style="margin-bottom:12px">
                    <label style="display:block;font-weight:500;margin-bottom:6px;color:#374151;font-size:14px">
                        Gambar Utama Saat Ini
                    </label>
                    <img src="{{ asset('storage/' . $homepageContent->image_path) }}" 
                         alt="Current Image" 
                         style="max-width:300px;border-radius:8px;border:1px solid #e0e6f1">
                </div>
                @endif
                
                <!-- Current Multiple Images -->
                @if($homepageContent->images && count($homepageContent->images) > 0)
                <div style="margin-bottom:16px">
                    <label style="display:block;font-weight:500;margin-bottom:8px;color:#374151;font-size:14px">
                        <i class="fas fa-images" style="color:#3b82f6"></i> Multiple Images Saat Ini (Drag untuk ubah urutan)
                    </label>
                    <div id="existingImagesContainer" style="display:flex;flex-direction:column;gap:10px;max-height:300px;overflow-y:auto;padding:12px;background:#f9fafb;border-radius:8px;border:1px solid #e0e6f1">
                        @foreach($homepageContent->images as $index => $img)
                        <div class="existing-image-item" 
                             draggable="true" 
                             data-index="{{ $index }}"
                             data-path="{{ $img }}"
                             style="display:flex;align-items:center;gap:12px;padding:8px;background:#fff;border-radius:6px;border:1px solid #e0e6f1;position:relative;cursor:move;transition:all 0.2s">
                            <div style="cursor:move;color:#6b7280;padding:0 4px">
                                <i class="fas fa-grip-vertical"></i>
                            </div>
                            <img src="{{ asset('storage/' . $img) }}" 
                                 alt="Image {{ $index + 1 }}"
                                 style="width:80px;height:80px;object-fit:cover;border-radius:6px;border:1px solid #ddd">
                            <div style="flex:1">
                                <div style="font-weight:600;color:#374151;margin-bottom:4px">
                                    <i class="fas fa-image" style="color:#3b82f6"></i> {{ basename($img) }}
                                </div>
                                <div style="font-size:12px;color:#6b7280">
                                    Gambar yang sudah tersimpan
                                </div>
                            </div>
                            <div style="background:#10b981;color:#fff;padding:4px 8px;border-radius:4px;font-size:12px;font-weight:600">
                                #{{ $index + 1 }}
                            </div>
                            <button type="button" 
                                    onclick="removeExistingImage({{ $index }})"
                                    style="position:absolute;top:8px;right:8px;background:#ef4444;color:#fff;border:none;border-radius:50%;width:24px;height:24px;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:14px;font-weight:700;z-index:10">
                                ×
                            </button>
                        </div>
                        @endforeach
                    </div>
                    <input type="hidden" name="existing_images" id="existingImagesInput" value="{{ json_encode($homepageContent->images) }}">
                    <input type="hidden" name="deleted_images" id="deletedImagesInput" value="[]">
                </div>
                @endif
                
                <!-- Single Image Upload -->
                <div style="margin-bottom:12px">
                    <label style="display:block;font-weight:500;margin-bottom:6px;color:#374151;font-size:14px">
                        Gambar Utama (Single)
                    </label>
                    <input type="file" 
                           name="image" 
                           accept="image/jpeg,image/png,image/jpg"
                           style="width:100%;padding:10px;border:1px solid #e0e6f1;border-radius:6px;font-size:14px;background:#fff">
                </div>
                
                <!-- Multiple Images Upload -->
                <div>
                    <label style="display:block;font-weight:500;margin-bottom:6px;color:#374151;font-size:14px;">
                        Multiple Images (Slider/Carousel)
                    </label>
                    <input type="file" 
                           name="images[]" 
                           id="multipleImages"
                           accept="image/jpeg,image/png,image/jpg"
                           multiple
                           onchange="previewMultipleImages(this)"
                           style="width:100%;padding:10px;border:1px solid #e0e6f1;border-radius:6px;font-size:14px;background:#fff">
                    <small style="color:#6b7280;margin-top:4px;display:block">
                        <i class="fas fa-info-circle"></i> Kosongkan jika tidak ingin mengubah. Pilih multiple file untuk slider. Format: JPG, PNG. Max: 2MB per file.
                    </small>
                    
                    <!-- Preview Container -->
                    <div id="imagePreviewContainer" style="margin-top:12px;display:none">
                        <label style="display:block;font-weight:500;margin-bottom:8px;color:#374151;font-size:14px;">
                            <i class="fas fa-grip-vertical" style="color:#3b82f6"></i> Preview Gambar (Drag untuk ubah urutan):
                        </label>
                        <div id="imagePreviewList" style="display:flex;flex-direction:column;gap:10px;max-height:300px;overflow-y:auto;padding:12px;background:#f9fafb;border-radius:8px;border:1px solid #e0e6f1">
                        </div>
                    </div>
                </div>
            </div>

            <script>
            let selectedFiles = [];
            let draggedIndex = null;
            
            function previewMultipleImages(input) {
                const container = document.getElementById('imagePreviewContainer');
                const previewList = document.getElementById('imagePreviewList');
                
                if (input.files && input.files.length > 0) {
                    container.style.display = 'block';
                    
                    // Tambahkan file baru ke array
                    Array.from(input.files).forEach(file => {
                        selectedFiles.push(file);
                    });
                    
                    // Render preview
                    renderPreview();
                    updateFileInput();
                    input.value = '';
                } else {
                    if (selectedFiles.length === 0) {
                        container.style.display = 'none';
                        previewList.innerHTML = '';
                    }
                }
            }
            
            function renderPreview() {
                const previewList = document.getElementById('imagePreviewList');
                previewList.innerHTML = '';
                
                selectedFiles.forEach((file, index) => {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        const itemDiv = document.createElement('div');
                        itemDiv.draggable = true;
                        itemDiv.dataset.index = index;
                        itemDiv.style.cssText = 'display:flex;align-items:center;gap:12px;padding:8px;background:#fff;border-radius:6px;border:1px solid #e0e6f1;position:relative;cursor:move;transition:all 0.2s';
                        
                        itemDiv.addEventListener('dragstart', handleDragStart);
                        itemDiv.addEventListener('dragover', handleDragOver);
                        itemDiv.addEventListener('drop', handleDrop);
                        itemDiv.addEventListener('dragend', handleDragEnd);
                        itemDiv.addEventListener('dragenter', function() {
                            if (this.dataset.index != draggedIndex) {
                                this.style.borderColor = '#3b82f6';
                                this.style.background = '#eff6ff';
                            }
                        });
                        itemDiv.addEventListener('dragleave', function() {
                            this.style.borderColor = '#e0e6f1';
                            this.style.background = '#fff';
                        });
                        
                        itemDiv.innerHTML = `
                            <div style="cursor:move;color:#6b7280;padding:0 4px">
                                <i class="fas fa-grip-vertical"></i>
                            </div>
                            <img src="${e.target.result}" 
                                 style="width:80px;height:80px;object-fit:cover;border-radius:6px;border:1px solid #ddd">
                            <div style="flex:1">
                                <div style="font-weight:600;color:#374151;margin-bottom:4px">
                                    <i class="fas fa-image" style="color:#3b82f6"></i> ${file.name}
                                </div>
                                <div style="font-size:12px;color:#6b7280">
                                    ${(file.size / 1024).toFixed(2)} KB
                                </div>
                            </div>
                            <div style="background:#10b981;color:#fff;padding:4px 8px;border-radius:4px;font-size:12px;font-weight:600">
                                #${index + 1}
                            </div>
                            <button type="button" onclick="removeImage(${index})" 
                                    style="position:absolute;top:8px;right:8px;background:#ef4444;color:#fff;border:none;border-radius:50%;width:24px;height:24px;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:14px;font-weight:700;z-index:10">
                                ×
                            </button>
                        `;
                        
                        previewList.appendChild(itemDiv);
                    };
                    
                    reader.readAsDataURL(file);
                });
            }
            
            function handleDragStart(e) {
                draggedIndex = parseInt(this.dataset.index);
                this.style.opacity = '0.5';
                e.dataTransfer.effectAllowed = 'move';
            }
            
            function handleDragOver(e) {
                if (e.preventDefault) {
                    e.preventDefault();
                }
                e.dataTransfer.dropEffect = 'move';
                return false;
            }
            
            function handleDrop(e) {
                if (e.stopPropagation) {
                    e.stopPropagation();
                }
                
                const dropIndex = parseInt(this.dataset.index);
                
                if (draggedIndex !== null && draggedIndex !== dropIndex) {
                    const draggedFile = selectedFiles[draggedIndex];
                    selectedFiles.splice(draggedIndex, 1);
                    selectedFiles.splice(dropIndex, 0, draggedFile);
                    
                    renderPreview();
                    updateFileInput();
                }
                
                this.style.borderColor = '#e0e6f1';
                this.style.background = '#fff';
                return false;
            }
            
            function handleDragEnd(e) {
                this.style.opacity = '1';
                this.style.borderColor = '#e0e6f1';
                this.style.background = '#fff';
                draggedIndex = null;
            }
            
            function removeImage(index) {
                selectedFiles.splice(index, 1);
                
                const container = document.getElementById('imagePreviewContainer');
                
                if (selectedFiles.length === 0) {
                    container.style.display = 'none';
                    document.getElementById('imagePreviewList').innerHTML = '';
                } else {
                    renderPreview();
                }
                
                updateFileInput();
            }
            
            function updateFileInput() {
                const input = document.getElementById('multipleImages');
                const dataTransfer = new DataTransfer();
                
                selectedFiles.forEach(file => {
                    dataTransfer.items.add(file);
                });
                
                input.files = dataTransfer.files;
            }
            
            // Handle Existing Images
            let existingImages = [];
            let deletedImages = [];
            let existingDraggedIndex = null;
            
            document.addEventListener('DOMContentLoaded', function() {
                const existingImagesInput = document.getElementById('existingImagesInput');
                if (existingImagesInput && existingImagesInput.value) {
                    existingImages = JSON.parse(existingImagesInput.value);
                }
                
                setupExistingImagesDrag();
            });
            
            function setupExistingImagesDrag() {
                const items = document.querySelectorAll('.existing-image-item');
                
                items.forEach(item => {
                    item.addEventListener('dragstart', function(e) {
                        existingDraggedIndex = parseInt(this.dataset.index);
                        this.style.opacity = '0.5';
                        e.dataTransfer.effectAllowed = 'move';
                    });
                    
                    item.addEventListener('dragover', function(e) {
                        if (e.preventDefault) {
                            e.preventDefault();
                        }
                        e.dataTransfer.dropEffect = 'move';
                        return false;
                    });
                    
                    item.addEventListener('drop', function(e) {
                        if (e.stopPropagation) {
                            e.stopPropagation();
                        }
                        
                        const dropIndex = parseInt(this.dataset.index);
                        
                        if (existingDraggedIndex !== null && existingDraggedIndex !== dropIndex) {
                            const draggedImg = existingImages[existingDraggedIndex];
                            existingImages.splice(existingDraggedIndex, 1);
                            existingImages.splice(dropIndex, 0, draggedImg);
                            
                            renderExistingImages();
                        }
                        
                        this.style.borderColor = '#e0e6f1';
                        this.style.background = '#fff';
                        return false;
                    });
                    
                    item.addEventListener('dragend', function(e) {
                        this.style.opacity = '1';
                        this.style.borderColor = '#e0e6f1';
                        this.style.background = '#fff';
                        existingDraggedIndex = null;
                    });
                    
                    item.addEventListener('dragenter', function() {
                        if (this.dataset.index != existingDraggedIndex) {
                            this.style.borderColor = '#3b82f6';
                            this.style.background = '#eff6ff';
                        }
                    });
                    
                    item.addEventListener('dragleave', function() {
                        this.style.borderColor = '#e0e6f1';
                        this.style.background = '#fff';
                    });
                });
            }
            
            function removeExistingImage(index) {
                const imagePath = existingImages[index];
                deletedImages.push(imagePath);
                existingImages.splice(index, 1);
                
                renderExistingImages();
            }
            
            function renderExistingImages() {
                const container = document.getElementById('existingImagesContainer');
                if (!container) return;
                
                if (existingImages.length === 0) {
                    container.parentElement.style.display = 'none';
                    return;
                }
                
                container.innerHTML = '';
                
                existingImages.forEach((img, index) => {
                    const itemDiv = document.createElement('div');
                    itemDiv.className = 'existing-image-item';
                    itemDiv.draggable = true;
                    itemDiv.dataset.index = index;
                    itemDiv.dataset.path = img;
                    itemDiv.style.cssText = 'display:flex;align-items:center;gap:12px;padding:8px;background:#fff;border-radius:6px;border:1px solid #e0e6f1;position:relative;cursor:move;transition:all 0.2s';
                    
                    const fileName = img.split('/').pop();
                    
                    itemDiv.innerHTML = `
                        <div style="cursor:move;color:#6b7280;padding:0 4px">
                            <i class="fas fa-grip-vertical"></i>
                        </div>
                        <img src="{{ asset('storage') }}/${img}" 
                             alt="Image ${index + 1}"
                             style="width:80px;height:80px;object-fit:cover;border-radius:6px;border:1px solid #ddd">
                        <div style="flex:1">
                            <div style="font-weight:600;color:#374151;margin-bottom:4px">
                                <i class="fas fa-image" style="color:#3b82f6"></i> ${fileName}
                            </div>
                            <div style="font-size:12px;color:#6b7280">
                                Gambar yang sudah tersimpan
                            </div>
                        </div>
                        <div style="background:#10b981;color:#fff;padding:4px 8px;border-radius:4px;font-size:12px;font-weight:600">
                            #${index + 1}
                        </div>
                        <button type="button" 
                                onclick="removeExistingImage(${index})"
                                style="position:absolute;top:8px;right:8px;background:#ef4444;color:#fff;border:none;border-radius:50%;width:24px;height:24px;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:14px;font-weight:700;z-index:10">
                            ×
                        </button>
                    `;
                    
                    container.appendChild(itemDiv);
                });
                
                setupExistingImagesDrag();
                
                // Update hidden inputs
                document.getElementById('existingImagesInput').value = JSON.stringify(existingImages);
                document.getElementById('deletedImagesInput').value = JSON.stringify(deletedImages);
            }
            </script>

            <!-- Urutan -->
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
                <div>
                    <label style="display:block;font-weight:600;margin-bottom:8px;color:#102a43">
                        Urutan Tampil
                    </label>
                    <input type="number" 
                           name="order" 
                           value="{{ old('order', $homepageContent->order) }}"
                           min="0"
                           style="width:100%;padding:10px;border:1px solid #e0e6f1;border-radius:6px;font-size:14px">
                </div>

                <!-- Status Aktif -->
                <div>
                    <label style="display:block;font-weight:600;margin-bottom:8px;color:#102a43">
                        Status
                    </label>
                    <label style="display:flex;align-items:center;gap:10px;cursor:pointer;padding:10px;border:1px solid #e0e6f1;border-radius:6px;background:#fff">
                        <input type="checkbox" 
                               name="is_active" 
                               value="1"
                               {{ old('is_active', $homepageContent->is_active) ? 'checked' : '' }}
                               style="width:18px;height:18px;cursor:pointer">
                        <span style="font-weight:500;color:#102a43">Tampilkan di beranda</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Tombol -->
        <div style="margin-top:28px;padding-top:20px;border-top:1px solid #e0e6f1;display:flex;gap:12px">
            <button type="submit" 
                    style="background:#0066cc;color:#fff;padding:12px 24px;border-radius:6px;border:none;cursor:pointer;font-weight:600;font-size:15px">
                <i class="fas fa-save"></i> Update Konten
            </button>
            <a href="{{ route('admin.homepage_content.index') }}" 
               style="background:#6b7280;color:#fff;padding:12px 24px;border-radius:6px;text-decoration:none;display:inline-block;font-weight:600;font-size:15px">
                <i class="fas fa-times"></i> Batal
            </a>
        </div>
    </form>
</div>

<!-- TinyMCE Editor -->
<script src="https://cdn.tiny.cloud/1/8tl1sdspny4tps0toc69t7n9p6w9lv47lz64n1bvnbj3glzd/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#contentEditor',
        height: 400,
        menubar: false,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'charmap', 'preview',
            'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | formatselect | bold italic | ' +
            'alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist outdent indent | removeformat | help',
        content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; font-size: 14px; line-height: 1.6; }',
        placeholder: 'Tulis konten di sini... Gunakan toolbar untuk membuat bullet points, numbered list, dll.',
        branding: false,
        statusbar: false
    });
</script>
@endsection
