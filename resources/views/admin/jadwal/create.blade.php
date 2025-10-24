<x-layouts.admin :title="'Tambah Jadwal Ibadah/Rapat'">
    <h2 style="color:#003a8c;font-weight:700;margin-bottom:1rem;">Tambah Jadwal Baru</h2>
    <form method="post" action="{{ route('admin.jadwal.store') }}" style="max-width:500px;background:#fff;padding:24px;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,0.04);">
        @csrf
        <div class="mb-2">
            <label>Tanggal & Waktu</label>
            <input type="datetime-local" name="tanggal_waktu" value="{{ old('tanggal_waktu') }}" required style="width:100%;padding:10px;border:1px solid #e0e6f1;border-radius:6px;">
            @error('tanggal_waktu')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-2">
            <label>Jenis Acara</label>
            <input type="text" name="jenis_acara" value="{{ old('jenis_acara') }}" required style="width:100%;padding:10px;border:1px solid #e0e6f1;border-radius:6px;">
            @error('jenis_acara')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-2">
            <label>Pelayan Firman</label>
            <input type="text" name="pelayan_firman" value="{{ old('pelayan_firman') }}" style="width:100%;padding:10px;border:1px solid #e0e6f1;border-radius:6px;">
        </div>
        <button class="action-button" type="submit"><i class="fas fa-save"></i> Simpan Jadwal</button>
        <a href="{{ route('admin.jadwal.index') }}" class="action-button" style="background:#6b7280;margin-left:8px;">Batal</a>
    </form>
</x-layouts.admin>
