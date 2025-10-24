@extends('layouts.app')

@section('content')
<section class="page-content">
    <h2 class="title" style="font-size: 32px; color: var(--blue-1); margin-bottom: 24px;">Hubungi Kami</h2>
    
    @if(session('success'))
    <div style="background:#d4edda;color:#155724;padding:16px;border-radius:8px;margin-bottom:24px;border-left:4px solid #28a745">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div style="background:#f8d7da;color:#721c24;padding:16px;border-radius:8px;margin-bottom:24px;border-left:4px solid #dc3545">
        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
    </div>
    @endif

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
        <!-- Informasi Kontak Kantor -->
        <div class="box">
            <h4 style="color:#003a8c;margin-bottom:20px;font-size:20px">
                <i class="fas fa-info-circle"></i> Informasi Kontak Kantor
            </h4>
            
            <div style="margin-bottom:16px">
                <p style="color:#6b7280;font-size:14px;margin-bottom:4px">
                    <i class="fas fa-map-marker-alt" style="width:20px;color:#003a8c"></i> <strong>Alamat:</strong>
                </p>
                <p style="margin-left:24px;line-height:1.6">
                    {{ $settings['alamat_gereja'] ?? $profile->alamat ?? 'Alamat belum diatur' }}
                </p>
            </div>

            <div style="margin-bottom:16px">
                <p style="color:#6b7280;font-size:14px">
                    <i class="fas fa-phone" style="width:20px;color:#003a8c"></i> <strong>Telepon:</strong> 
                    {{ $settings['telepon_kantor'] ?? $profile->telepon ?? '-' }}
                </p>
            </div>

            <div style="margin-bottom:16px">
                <p style="color:#6b7280;font-size:14px">
                    <i class="fas fa-envelope" style="width:20px;color:#003a8c"></i> <strong>Email:</strong> 
                    {{ $settings['email_kantor'] ?? $profile->email ?? '-' }}
                </p>
            </div>

            <div style="margin-top:24px;padding:12px;background:#f8f9fa;border-radius:6px">
                <p style="color:#6b7280;font-size:14px">
                    <i class="fas fa-clock" style="color:#003a8c"></i> <strong>Jam Pelayanan Kantor:</strong>
                </p>
                <p style="margin-left:24px;margin-top:4px">{{ $settings['jam_pelayanan'] ?? 'Senin - Jumat, 09:00 - 15:00 WIB' }}</p>
            </div>

            @if(isset($settings['google_maps_url']) && $settings['google_maps_url'])
            <div style="margin-top:16px">
                <a href="{{ $settings['google_maps_url'] }}" 
                   target="_blank" 
                   style="display:inline-flex;align-items:center;gap:8px;background:#0066cc;color:#fff;padding:10px 16px;border-radius:6px;text-decoration:none;font-weight:600">
                    <i class="fas fa-map-marked-alt"></i> Lihat di Google Maps
                </a>
            </div>
            @endif
        </div>

        <!-- Form Kirim Pesan -->
        <div class="box">
            <h4 style="color:#003a8c;margin-bottom:20px;font-size:20px">
                <i class="fas fa-paper-plane"></i> Kirimkan Pesan Anda
            </h4>
            
            <form method="POST" action="{{ route('kontak.store') }}">
                @csrf
                
                <div style="margin-bottom:16px">
                    <label style="display:block;font-weight:600;margin-bottom:6px;color:#102a43">
                        Nama Anda <span style="color:#dc3545">*</span>
                    </label>
                    <input type="text" 
                           name="name" 
                           value="{{ old('name') }}"
                           placeholder="Masukkan nama lengkap Anda" 
                           required 
                           style="width: 100%; padding: 12px; border: 1px solid {{ $errors->has('name') ? '#dc3545' : '#e0e6f1' }}; border-radius: 6px;">
                    @error('name')
                    <p style="color:#dc3545;font-size:13px;margin-top:4px">{{ $message }}</p>
                    @enderror
                </div>

                <div style="margin-bottom:16px">
                    <label style="display:block;font-weight:600;margin-bottom:6px;color:#102a43">
                        Email Anda <span style="color:#dc3545">*</span>
                    </label>
                    <input type="email" 
                           name="email" 
                           value="{{ old('email') }}"
                           placeholder="nama@email.com" 
                           required 
                           style="width: 100%; padding: 12px; border: 1px solid {{ $errors->has('email') ? '#dc3545' : '#e0e6f1' }}; border-radius: 6px;">
                    @error('email')
                    <p style="color:#dc3545;font-size:13px;margin-top:4px">{{ $message }}</p>
                    @enderror
                </div>

                <div style="margin-bottom:20px">
                    <label style="display:block;font-weight:600;margin-bottom:6px;color:#102a43">
                        Pesan Anda <span style="color:#dc3545">*</span>
                    </label>
                    <textarea name="message" 
                              rows="6" 
                              placeholder="Tuliskan pesan atau pertanyaan Anda di sini..." 
                              required
                              style="width: 100%; padding: 12px; border: 1px solid {{ $errors->has('message') ? '#dc3545' : '#e0e6f1' }}; border-radius: 6px; resize: vertical;">{{ old('message') }}</textarea>
                    @error('message')
                    <p style="color:#dc3545;font-size:13px;margin-top:4px">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" 
                        class="action-button"
                        style="background: #28a745; color: #fff; border: none; padding: 12px 24px; border-radius: 6px; font-weight: 600; cursor: pointer; transition: background 0.3s; width: 100%;">
                    <i class="fas fa-paper-plane"></i> Kirim Pesan
                </button>
            </form>
        </div>
    </div>
</section>
@endsection
