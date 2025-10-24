<x-layouts.admin :title="'Data Jemaat'">
    <div class="dashboard-module">
        <h2 style="color: var(--blue-1);">Data Jemaat</h2>
        <p style="color: var(--muted);">Manajemen detail anggota jemaat.</p>

        <div class="table-controls" style="display:flex;justify-content:space-between;align-items:center;margin:15px 0;">
            <a href="{{ route('admin.jemaat.create') }}" class="action-button" style="background:#0d6efd"><i class="fas fa-plus"></i> Tambah Jemaat Baru</a>
        </div>

        <form method="get" style="display:flex;gap:12px;margin-bottom:10px;align-items:center;">
            <input type="text" name="q" value="{{ $q }}" placeholder="Cari Nama/Sektor..." style="flex:1;padding:10px;border:1px solid #ccc;border-radius:6px;">
            <select name="status" style="padding:10px;border:1px solid #ccc;border-radius:6px;">
                <option value="">Semua Status Baptis</option>
                <option value="Sudah Baptis" {{ $status=='Sudah Baptis' ? 'selected' : '' }}>Sudah Baptis</option>
                <option value="Belum Baptis" {{ $status=='Belum Baptis' ? 'selected' : '' }}>Belum Baptis</option>
            </select>
            <select name="sektor" style="padding:10px;border:1px solid #ccc;border-radius:6px;">
                <option value="all">Semua Sektor</option>
                @foreach($sektors as $s)
                    <option value="{{ $s }}" {{ $sektor==$s ? 'selected' : '' }}>{{ $s }}</option>
                @endforeach
            </select>
            <button class="action-button" type="submit"><i class="fas fa-search"></i></button>
        </form>

        <div style="background:#fff;border-radius:8px;box-shadow:0 2px 5px rgba(0,0,0,0.05);overflow-x:auto;">
            <table class="data-table" style="width:100%;border-collapse:collapse;">
                <thead>
                    <tr>
                        <th style="width:15%">Nama Lengkap</th>
                        <th style="width:10%">Tgl. Lahir</th>
                        <th style="width:15%">Alamat</th>
                        <th style="width:10%">Telepon</th>
                        <th style="width:10%">Status Baptis</th>
                        <th style="width:10%">Status Sidi</th>
                        <th style="width:10%">Pekerjaan</th>
                        <th style="width:10%">Keluarga/KK</th>
                        <th style="width:8%">Sektor</th>
                        <th style="width:12%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jemaats as $j)
                        <tr>
                            <td>{{ $j->nama_lengkap }}</td>
                            <td>{{ optional($j->tgl_lahir)->format('d/m/Y') }}</td>
                            <td>{{ Str::limit($j->alamat ?? '-', 30) }}</td>
                            <td>{{ $j->telepon ?? '-' }}</td>
                            <td>{{ $j->status_baptis }}</td>
                            <td>{{ $j->status_sidi ?? 'Belum Sidi' }}</td>
                            <td>{{ $j->pekerjaan ?? '-' }}</td>
                            <td>{{ $j->keluarga ?? '-' }}</td>
                            <td>{{ $j->sektor ?? '-' }}</td>
                            <td>
                                <a href="{{ route('admin.jemaat.edit', $j) }}" class="action-button" title="Edit" style="background:#0dcaf0;color:#000"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.jemaat.destroy', $j) }}" method="post" style="display:inline" onsubmit="return confirm('Hapus data ini?')">
                                    @csrf @method('DELETE')
                                    <button class="action-button" title="Hapus" style="background:#dc3545"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="10">Belum ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div style="margin-top:12px;">{{ $jemaats->links() }}</div>
    </div>
</x-layouts.admin>
