<x-layouts.admin :title="'Edit Jemaat'">
    <div class="dashboard-module">
        <form method="post" action="{{ route('admin.jemaat.update', $jemaat) }}">
            @csrf @method('PUT')
            <div class="mb-2">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $jemaat->nama_lengkap) }}" required style="width:100%;padding:10px;border:1px solid #e0e6f1;border-radius:6px;">
                @error('nama_lengkap')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="mb-2">
                <label>Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" value="{{ old('tgl_lahir', optional($jemaat->tgl_lahir)->format('Y-m-d')) }}" style="padding:10px;border:1px solid #e0e6f1;border-radius:6px;">
            </div>
            <div class="mb-2">
                <label>Alamat</label>
                <textarea name="alamat" rows="3" style="width:100%;padding:10px;border:1px solid #e0e6f1;border-radius:6px;">{{ old('alamat', $jemaat->alamat) }}</textarea>
            </div>
            <div class="mb-2">
                <label>Telepon</label>
                <input type="text" name="telepon" value="{{ old('telepon', $jemaat->telepon) }}" placeholder="Contoh: 08123456789" style="padding:10px;border:1px solid #e0e6f1;border-radius:6px;">
            </div>
            <div class="mb-2">
                <label>Status Baptis</label>
                <select name="status_baptis" style="padding:10px;border:1px solid #e0e6f1;border-radius:6px;">
                    <option value="Sudah Baptis" {{ old('status_baptis', $jemaat->status_baptis)=='Sudah Baptis'?'selected':'' }}>Sudah Baptis</option>
                    <option value="Belum Baptis" {{ old('status_baptis', $jemaat->status_baptis)=='Belum Baptis'?'selected':'' }}>Belum Baptis</option>
                </select>
            </div>
            <div class="mb-2">
                <label>Status Sidi</label>
                <select name="status_sidi" style="padding:10px;border:1px solid #e0e6f1;border-radius:6px;">
                    <option value="Sudah Sidi" {{ old('status_sidi', $jemaat->status_sidi ?? 'Belum Sidi')=='Sudah Sidi'?'selected':'' }}>Sudah Sidi</option>
                    <option value="Belum Sidi" {{ old('status_sidi', $jemaat->status_sidi ?? 'Belum Sidi')=='Belum Sidi'?'selected':'' }}>Belum Sidi</option>
                </select>
            </div>
            <div class="mb-2">
                <label>Pekerjaan</label>
                <input type="text" name="pekerjaan" value="{{ old('pekerjaan', $jemaat->pekerjaan) }}" placeholder="Contoh: Guru, Pegawai Swasta" style="padding:10px;border:1px solid #e0e6f1;border-radius:6px;">
            </div>
            <div class="mb-2">
                <label>Keluarga / KK</label>
                <input type="text" name="keluarga" value="{{ old('keluarga', $jemaat->keluarga) }}" placeholder="Kepala Keluarga" style="padding:10px;border:1px solid #e0e6f1;border-radius:6px;">
            </div>
            <div class="mb-2">
                <label>Sektor</label>
                <input type="text" name="sektor" value="{{ old('sektor', $jemaat->sektor) }}" placeholder="Contoh: Sektor 1" style="padding:10px;border:1px solid #e0e6f1;border-radius:6px;">
            </div>
            <button class="action-button" type="submit"><i class="fas fa-save"></i> Simpan</button>
        </form>
    </div>
</x-layouts.admin>
