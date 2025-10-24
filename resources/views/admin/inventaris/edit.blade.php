@extends('layouts.admin')

@section('content')
<div style="max-width:800px;margin:0 auto;">
    <h1 style="font-size:2rem;font-weight:700;color:#003a8c;margin-bottom:0.5rem;">Edit Item Inventaris</h1>
    <p style="color:#6b7280;margin-bottom:1.5rem;">Perbarui informasi aset atau barang inventaris gereja</p>
    
    <div style="background:#fff;border-radius:12px;padding:32px;box-shadow:0 2px 8px rgba(0,0,0,0.08);">
        <form method="post" action="{{ route('admin.inventaris_aset.update',$item) }}">
            @csrf @method('PUT')
            
            <div style="margin-bottom:20px;">
                <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;font-size:14px;">
                    Nama Item <span style="color:#dc3545;">*</span>
                </label>
                <input name="nama" 
                       value="{{ $item->nama }}"
                       placeholder="Contoh: Kursi, Meja, Proyektor, dll" 
                       required
                       style="width:100%;padding:12px 16px;border:2px solid #e5e7eb;border-radius:8px;font-size:15px;transition:all 0.3s;box-sizing:border-box;"
                       onfocus="this.style.borderColor='#3b82f6';this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                       onblur="this.style.borderColor='#e5e7eb';this.style.boxShadow='none'">
            </div>
            
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:20px;">
                <div>
                    <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;font-size:14px;">
                        Kuantitas <span style="color:#dc3545;">*</span>
                    </label>
                    <input name="kuantitas" 
                           type="number" 
                           value="{{ $item->kuantitas }}"
                           min="1"
                           required
                           style="width:100%;padding:12px 16px;border:2px solid #e5e7eb;border-radius:8px;font-size:15px;transition:all 0.3s;box-sizing:border-box;"
                           onfocus="this.style.borderColor='#3b82f6';this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                           onblur="this.style.borderColor='#e5e7eb';this.style.boxShadow='none'">
                </div>
                
                <div>
                    <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;font-size:14px;">
                        Lokasi
                    </label>
                    <input name="lokasi" 
                           value="{{ $item->lokasi }}"
                           placeholder="Contoh: Ruang Ibadah, Kantor, dll" 
                           style="width:100%;padding:12px 16px;border:2px solid #e5e7eb;border-radius:8px;font-size:15px;transition:all 0.3s;box-sizing:border-box;"
                           onfocus="this.style.borderColor='#3b82f6';this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                           onblur="this.style.borderColor='#e5e7eb';this.style.boxShadow='none'">
                </div>
            </div>
            
            <div style="margin-bottom:20px;">
                <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;font-size:14px;">
                    Nomor Serial
                </label>
                <input name="nomor_serial" 
                       value="{{ $item->nomor_serial }}"
                       placeholder="Nomor serial atau kode identifikasi (opsional)" 
                       style="width:100%;padding:12px 16px;border:2px solid #e5e7eb;border-radius:8px;font-size:15px;transition:all 0.3s;box-sizing:border-box;"
                       onfocus="this.style.borderColor='#3b82f6';this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                       onblur="this.style.borderColor='#e5e7eb';this.style.boxShadow='none'">
            </div>
            
            <div style="margin-bottom:24px;">
                <label style="display:block;font-weight:600;color:#374151;margin-bottom:8px;font-size:14px;">
                    Keterangan
                </label>
                <textarea name="keterangan" 
                          rows="4" 
                          placeholder="Deskripsi kondisi, spesifikasi, atau catatan lainnya..." 
                          style="width:100%;padding:12px 16px;border:2px solid #e5e7eb;border-radius:8px;font-size:15px;transition:all 0.3s;resize:vertical;box-sizing:border-box;font-family:inherit;"
                          onfocus="this.style.borderColor='#3b82f6';this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                          onblur="this.style.borderColor='#e5e7eb';this.style.boxShadow='none'">{{ $item->keterangan }}</textarea>
            </div>
            
            <div style="display:flex;gap:12px;justify-content:flex-end;padding-top:16px;border-top:2px solid #f3f4f6;">
                <a href="{{ route('admin.inventaris_aset') }}" 
                   class="action-button" 
                   style="background:#6b7280;padding:12px 24px;border-radius:8px;font-weight:600;text-decoration:none;display:inline-block;">
                    <i class="fas fa-arrow-left"></i> Batal
                </a>
                <button type="submit" 
                        class="action-button" 
                        style="background:linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);padding:12px 32px;border-radius:8px;font-weight:600;box-shadow:0 4px 12px rgba(59,130,246,0.3);">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
