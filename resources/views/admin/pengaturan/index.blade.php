@extends('layouts.admin')

@section('content')
<div class="dashboard-module">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px">
        <h2 style="font-size:24px;font-weight:700;color:#0b132b">⚙️ Pengaturan Umum Website</h2>
    </div>

    @if(session('success'))
    <div style="background:#d4edda;color:#155724;padding:12px 16px;border-radius:6px;margin-bottom:20px;border:1px solid #c3e6cb">
        ✓ {{ session('success') }}
    </div>
    @endif

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

    <form action="{{ route('admin.pengaturan_umum.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Tab Navigation -->
        <div style="border-bottom:2px solid #e0e6f1;margin-bottom:24px">
            <div style="display:flex;gap:8px;flex-wrap:wrap">
                <button type="button" class="tab-button active" onclick="switchTab('kontak')" id="tab-kontak">
                    <i class="fas fa-address-card"></i> Kontak & Website
                </button>
                <button type="button" class="tab-button" onclick="switchTab('media')" id="tab-media">
                    <i class="fas fa-share-alt"></i> Media Sosial
                </button>
                <button type="button" class="tab-button" onclick="switchTab('visual')" id="tab-visual">
                    <i class="fas fa-palette"></i> Visual & Sistem
                </button>
            </div>
        </div>

        <!-- Tab Content: Grup 1 - Kontak & Website -->
        <div class="tab-content active" id="content-kontak">
            <h3 style="font-size:18px;font-weight:600;margin-bottom:16px;color:#003a8c">
                📍 Informasi Kontak & Website
            </h3>
            
            <div style="display:grid;gap:16px">
                <!-- Alamat Gereja -->
                <div>
                    <label style="display:block;font-weight:600;margin-bottom:6px;color:#102a43">
                        Alamat Gereja <span style="color:#dc3545">*</span>
                    </label>
                    <textarea 
                        name="alamat_gereja" 
                        rows="3" 
                        required
                        placeholder="Masukkan alamat lengkap gereja..."
                        style="width:100%;padding:10px;border:1px solid #e0e6f1;border-radius:6px;font-size:14px"
                    >{{ old('alamat_gereja', $settings['alamat_gereja'] ?? '') }}</textarea>
                    <small style="color:#6b7280">Contoh: Jl. Raya Antan No. 123, Kec. Maranatha, Kab. Kupang, NTT 85361</small>
                </div>

                <!-- Nomor Telepon -->
                <div>
                    <label style="display:block;font-weight:600;margin-bottom:6px;color:#102a43">
                        Nomor Telepon Kantor
                    </label>
                    <input 
                        type="text" 
                        name="telepon_kantor" 
                        value="{{ old('telepon_kantor', $settings['telepon_kantor'] ?? '') }}"
                        placeholder="+62 380 1234567 atau 0380-1234567"
                        style="width:100%;padding:10px;border:1px solid #e0e6f1;border-radius:6px;font-size:14px"
                    >
                </div>

                <!-- Email Kantor -->
                <div>
                    <label style="display:block;font-weight:600;margin-bottom:6px;color:#102a43">
                        Email Kantor
                    </label>
                    <input 
                        type="email" 
                        name="email_kantor" 
                        value="{{ old('email_kantor', $settings['email_kantor'] ?? '') }}"
                        placeholder="info@gppikmaranatha.org"
                        style="width:100%;padding:10px;border:1px solid #e0e6f1;border-radius:6px;font-size:14px"
                    >
                </div>

                <!-- Jam Pelayanan -->
                <div>
                    <label style="display:block;font-weight:600;margin-bottom:6px;color:#102a43">
                        Jam Pelayanan Kantor
                    </label>
                    <input 
                        type="text" 
                        name="jam_pelayanan" 
                        value="{{ old('jam_pelayanan', $settings['jam_pelayanan'] ?? '') }}"
                        placeholder="Senin - Jumat, 09:00 - 15:00 WIB"
                        style="width:100%;padding:10px;border:1px solid #e0e6f1;border-radius:6px;font-size:14px"
                    >
                </div>

                <!-- Google Maps URL -->
                <div>
                    <label style="display:block;font-weight:600;margin-bottom:6px;color:#102a43">
                        Tautan Google Maps
                    </label>
                    <input 
                        type="url" 
                        name="google_maps_url" 
                        value="{{ old('google_maps_url', $settings['google_maps_url'] ?? '') }}"
                        placeholder="https://maps.google.com/..."
                        style="width:100%;padding:10px;border:1px solid #e0e6f1;border-radius:6px;font-size:14px"
                    >
                    <small style="color:#6b7280">
                        Buka Google Maps → Cari lokasi gereja → Klik "Bagikan" → Salin tautan
                    </small>
                </div>

                <!-- Copyright Text -->
                <div>
                    <label style="display:block;font-weight:600;margin-bottom:6px;color:#102a43">
                        Teks Hak Cipta (Footer)
                    </label>
                    <input 
                        type="text" 
                        name="copyright_text" 
                        value="{{ old('copyright_text', $settings['copyright_text'] ?? '© 2025 GPPIK Maranatha Antan. All rights reserved.') }}"
                        placeholder="© 2025 GPPIK Maranatha Antan. All rights reserved."
                        style="width:100%;padding:10px;border:1px solid #e0e6f1;border-radius:6px;font-size:14px"
                    >
                </div>

                <!-- Tampilkan Ayat Alkitab -->
                <div>
                    <label style="display:block;font-weight:600;margin-bottom:6px;color:#102a43">
                        Tampilkan Ayat Alkitab di Footer
                    </label>
                    <div style="display:flex;gap:20px;margin-bottom:16px">
                        <label style="display:flex;align-items:center;gap:8px;cursor:pointer">
                            <input 
                                type="radio" 
                                name="show_bible_verses" 
                                value="1" 
                                {{ old('show_bible_verses', $settings['show_bible_verses'] ?? '1') == '1' ? 'checked' : '' }}
                            >
                            <span>Ya</span>
                        </label>
                        <label style="display:flex;align-items:center;gap:8px;cursor:pointer">
                            <input 
                                type="radio" 
                                name="show_bible_verses" 
                                value="0" 
                                {{ old('show_bible_verses', $settings['show_bible_verses'] ?? '1') == '0' ? 'checked' : '' }}
                            >
                            <span>Tidak</span>
                        </label>
                    </div>
                </div>

                <!-- Ayat Alkitab 1 -->
                <div style="border:1px solid #e0e6f1;padding:16px;border-radius:8px;background:#f9fafb">
                    <h4 style="margin-bottom:12px;color:#003a8c;font-size:15px">📖 Ayat Alkitab #1 (Footer)</h4>
                    <div style="margin-bottom:12px">
                        <label style="display:block;font-weight:600;margin-bottom:6px;color:#102a43">
                            Referensi Ayat (contoh: Mazmur 133:1)
                        </label>
                        <input 
                            type="text" 
                            name="ayat_alkitab_1_ref" 
                            value="{{ old('ayat_alkitab_1_ref', $settings['ayat_alkitab_1_ref'] ?? 'Mazmur 133:1') }}"
                            placeholder="Mazmur 133:1"
                            style="width:100%;padding:10px;border:1px solid #e0e6f1;border-radius:6px;font-size:14px"
                        >
                    </div>
                    <div>
                        <label style="display:block;font-weight:600;margin-bottom:6px;color:#102a43">
                            Isi Ayat
                        </label>
                        <textarea 
                            name="ayat_alkitab_1_text" 
                            rows="3"
                            placeholder="Masukkan isi ayat..."
                            style="width:100%;padding:10px;border:1px solid #e0e6f1;border-radius:6px;font-size:14px"
                        >{{ old('ayat_alkitab_1_text', $settings['ayat_alkitab_1_text'] ?? 'Sungguh, alangkah baiknya dan indahnya, apabila saudara-saudara diam bersama dengan rukun.') }}</textarea>
                    </div>
                </div>

                <!-- Ayat Alkitab 2 -->
                <div style="border:1px solid #e0e6f1;padding:16px;border-radius:8px;background:#f9fafb">
                    <h4 style="margin-bottom:12px;color:#003a8c;font-size:15px">📖 Ayat Alkitab #2 (Footer)</h4>
                    <div style="margin-bottom:12px">
                        <label style="display:block;font-weight:600;margin-bottom:6px;color:#102a43">
                            Referensi Ayat (contoh: Filipi 4:13)
                        </label>
                        <input 
                            type="text" 
                            name="ayat_alkitab_2_ref" 
                            value="{{ old('ayat_alkitab_2_ref', $settings['ayat_alkitab_2_ref'] ?? 'Filipi 4:13') }}"
                            placeholder="Filipi 4:13"
                            style="width:100%;padding:10px;border:1px solid #e0e6f1;border-radius:6px;font-size:14px"
                        >
                    </div>
                    <div>
                        <label style="display:block;font-weight:600;margin-bottom:6px;color:#102a43">
                            Isi Ayat
                        </label>
                        <textarea 
                            name="ayat_alkitab_2_text" 
                            rows="3"
                            placeholder="Masukkan isi ayat..."
                            style="width:100%;padding:10px;border:1px solid #e0e6f1;border-radius:6px;font-size:14px"
                        >{{ old('ayat_alkitab_2_text', $settings['ayat_alkitab_2_text'] ?? 'Segala perkara dapat kutanggung di dalam Dia yang memberi kekuatan kepadaku.') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab Content: Grup 2 - Media Sosial -->
        <div class="tab-content" id="content-media">
            <h3 style="font-size:18px;font-weight:600;margin-bottom:16px;color:#003a8c">
                🌐 Tautan Media Sosial
            </h3>
            
            <div style="display:grid;gap:16px">
                <!-- Facebook -->
                <div>
                    <label style="display:block;font-weight:600;margin-bottom:6px;color:#102a43">
                        <i class="fab fa-facebook" style="color:#1877f2"></i> Facebook
                    </label>
                    <input 
                        type="url" 
                        name="facebook_url" 
                        value="{{ old('facebook_url', $settings['facebook_url'] ?? '') }}"
                        placeholder="https://facebook.com/gppikmaranatha"
                        style="width:100%;padding:10px;border:1px solid #e0e6f1;border-radius:6px;font-size:14px"
                    >
                </div>

                <!-- Instagram -->
                <div>
                    <label style="display:block;font-weight:600;margin-bottom:6px;color:#102a43">
                        <i class="fab fa-instagram" style="color:#e4405f"></i> Instagram
                    </label>
                    <input 
                        type="url" 
                        name="instagram_url" 
                        value="{{ old('instagram_url', $settings['instagram_url'] ?? '') }}"
                        placeholder="https://instagram.com/gppikmaranatha"
                        style="width:100%;padding:10px;border:1px solid #e0e6f1;border-radius:6px;font-size:14px"
                    >
                </div>

                <!-- YouTube -->
                <div>
                    <label style="display:block;font-weight:600;margin-bottom:6px;color:#102a43">
                        <i class="fab fa-youtube" style="color:#ff0000"></i> YouTube
                    </label>
                    <input 
                        type="url" 
                        name="youtube_url" 
                        value="{{ old('youtube_url', $settings['youtube_url'] ?? '') }}"
                        placeholder="https://youtube.com/@gppikmaranatha"
                        style="width:100%;padding:10px;border:1px solid #e0e6f1;border-radius:6px;font-size:14px"
                    >
                </div>
            </div>
        </div>

        <!-- Tab Content: Grup 3 - Visual & Sistem -->
        <div class="tab-content" id="content-visual">
            <h3 style="font-size:18px;font-weight:600;margin-bottom:16px;color:#003a8c">
                🎨 Pengaturan Visual & Sistem
            </h3>
            
            <div style="display:grid;gap:16px">
                <!-- Logo Website -->
                <div>
                    <label style="display:block;font-weight:600;margin-bottom:6px;color:#102a43">
                        Logo Website
                    </label>
                    
                    @if(isset($settings['logo_website']) && $settings['logo_website'])
                    <div style="margin-bottom:12px">
                        <img src="{{ asset('storage/' . $settings['logo_website']) }}" 
                             alt="Logo Current" 
                             style="max-width:150px;border:1px solid #e0e6f1;border-radius:6px;padding:8px">
                        <p style="margin-top:6px;font-size:13px;color:#6b7280">Logo saat ini</p>
                    </div>
                    @endif
                    
                    <input 
                        type="file" 
                        name="logo_website" 
                        accept="image/jpeg,image/png"
                        style="width:100%;padding:10px;border:1px solid #e0e6f1;border-radius:6px;font-size:14px"
                    >
                    <small style="color:#6b7280">Format yang diizinkan: JPEG atau PNG</small>
                </div>

                <!-- Favicon Website -->
                <div style="margin-top:20px;padding-top:20px;border-top:1px solid #e0e6f1">
                    <label style="display:block;font-weight:600;margin-bottom:6px;color:#102a43">
                        Favicon Website <i class="fas fa-info-circle" title="Ikon kecil yang muncul di tab browser"></i>
                    </label>
                    
                    @if(isset($settings['favicon']) && $settings['favicon'])
                    <div style="margin-bottom:12px">
                        <img src="{{ asset('storage/' . $settings['favicon']) }}" 
                             alt="Favicon Current" 
                             style="max-width:32px;border:1px solid #e0e6f1;border-radius:6px;padding:4px">
                        <p style="margin-top:6px;font-size:13px;color:#6b7280">Favicon saat ini</p>
                    </div>
                    @endif
                    
                    <input 
                        type="file" 
                        name="favicon" 
                        accept="image/jpeg,image/png"
                        style="width:100%;padding:10px;border:1px solid #e0e6f1;border-radius:6px;font-size:14px"
                    >
                    <small style="color:#6b7280">Format yang diizinkan: JPEG atau PNG</small>
                    <p style="margin-top:8px;font-size:13px;color:#6b7280">
                        💡 Tips: Gunakan gambar dengan latar belakang solid dan bentuk sederhana agar mudah terlihat di tab browser
                    </p>
                </div>

                <!-- Google Analytics -->
                <div>
                    <label style="display:block;font-weight:600;margin-bottom:6px;color:#102a43">
                        Kode Google Analytics / Tag Manager
                    </label>
                    <textarea 
                        name="google_analytics_code" 
                        rows="6" 
                        placeholder="<!-- Google tag (gtag.js) -->&#10;<script async src=&quot;https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX&quot;></script>"
                        style="width:100%;padding:10px;border:1px solid #e0e6f1;border-radius:6px;font-size:13px;font-family:monospace"
                    >{{ old('google_analytics_code', $settings['google_analytics_code'] ?? '') }}</textarea>
                                        <small style="color:#6b7280">Paste kode tracking dari Google Analytics atau Google Tag Manager</small>
                </div>
            </div>
        </div>


        <div style="margin-top:32px;padding-top:24px;border-top:2px solid #e0e6f1">
            <button 
                type="submit" 
                style="background:#0066cc;color:#fff;border:none;padding:12px 32px;border-radius:6px;font-size:16px;font-weight:600;cursor:pointer;display:inline-flex;align-items:center;gap:8px"
            >
                <i class="fas fa-save"></i> Simpan Semua Pengaturan
            </button>
            <p style="margin-top:12px;color:#6b7280;font-size:14px">
                💡 Perubahan akan langsung diterapkan ke seluruh website setelah disimpan
            </p>
        </div>
    </form>
</div>

<style>
    .tab-button {
        background: #f9fafb;
        border: none;
        border-bottom: 3px solid transparent;
        padding: 12px 20px;
        font-size: 15px;
        font-weight: 600;
        color: #6b7280;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .tab-button:hover {
        background: #eef3fb;
        color: #003a8c;
    }

    .tab-button.active {
        background: #fff;
        color: #0066cc;
        border-bottom-color: #0066cc;
    }

    .tab-content {
        display: none;
        animation: fadeIn 0.3s ease;
    }

    .tab-content.active {
        display: block;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<script>
    function switchTab(tabName) {
        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.remove('active');
        });
        
        // Remove active class from all tab buttons
        document.querySelectorAll('.tab-button').forEach(button => {
            button.classList.remove('active');
        });
        
        // Show selected tab content
        document.getElementById('content-' + tabName).classList.add('active');
        
        // Add active class to selected tab button
        document.getElementById('tab-' + tabName).classList.add('active');
    }
</script>
@endsection
