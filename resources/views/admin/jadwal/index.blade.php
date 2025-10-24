<x-layouts.admin :title="'Jadwal Ibadah & Rapat'">
    <h1 style="font-size:2rem;font-weight:700;color:#003a8c;margin-bottom:0.5rem;">Jadwal Ibadah & Rapat</h1>
    <p style="color:#6b7280;margin-bottom:1.5rem;">Mengatur jadwal pelayanan (pelayan Firman, liturgi, petugas, rapat majelis).</p>
    <div style="background:#fff;border-radius:10px;padding:24px;box-shadow:0 2px 8px rgba(0,0,0,0.04);max-width:1300px;margin-bottom:2rem;">
        <div style="margin-bottom:18px;display:flex;justify-content:space-between;align-items:center;">
            <span style="font-weight:600;font-size:1.1rem;">Manajemen Jadwal</span>
            <div style="display:flex;gap:10px;">
                <a href="{{ route('admin.jadwal.exportPdf') }}" class="action-button" style="background:#1e7ae8;color:#fff;display:flex;align-items:center;gap:6px;padding:8px 16px;border-radius:6px;text-decoration:none;">
                    <i class="fas fa-download"></i> Download PDF
                </a>
                <a href="{{ route('admin.jadwal.create') }}" class="action-button" style="background:#0d6efd"><i class="fas fa-plus"></i> Tambah Jadwal Baru</a>
            </div>
        </div>
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="background:#f9fafb;color:#0b132b;font-weight:600;">
                    <th style="padding:12px 8px;">Tanggal/Waktu</th>
                    <th style="padding:12px 8px;">Jenis Acara</th>
                    <th style="padding:12px 8px;">Pelayan Firman</th>
                    <th style="padding:12px 8px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jadwals as $j)
                        <tr>
                            <td style="padding:10px 8px;">{{ \Carbon\Carbon::parse($j->tanggal_waktu)->isoFormat('dddd, DD/MM/YYYY | HH:mm') }}</td>
                        <td style="padding:10px 8px;">{{ $j->jenis_acara }}</td>
                        <td style="padding:10px 8px;">{{ $j->pelayan_firman ?? '-' }}</td>
                        <td style="padding:10px 8px;">
                            <a href="{{ route('admin.jadwal.edit', $j) }}" title="Edit Jadwal"><i class="fas fa-edit"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" style="padding:10px 8px;">Belum ada jadwal.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts.admin>
