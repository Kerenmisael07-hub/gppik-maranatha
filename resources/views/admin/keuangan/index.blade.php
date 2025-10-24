@extends('layouts.admin')

@section('content')
    <h1 style="font-size:2rem;font-weight:700;color:#003a8c;margin-bottom:0.5rem;">Keuangan Gereja</h1>
    <p style="color:#6b7280;margin-bottom:1.5rem;">Pencatatan persembahan dan pengeluaran.</p>
    <div style="background:#fff;border-radius:10px;padding:24px;box-shadow:0 2px 8px rgba(0,0,0,0.04);max-width:1300px;margin-bottom:2rem;">
        <div style="margin-bottom:18px;display:flex;justify-content:space-between;align-items:center;">
            <span style="font-weight:600;font-size:1.1rem;">Pencatatan Transaksi</span>
            <div style="display:flex;gap:10px;">
                <a href="{{ route('admin.keuangan.create', 'Pemasukan') }}" class="action-button" style="background:#28a745"><i class="fas fa-arrow-up"></i> Catat Pemasukan</a>
                <a href="{{ route('admin.keuangan.create', 'Pengeluaran') }}" class="action-button" style="background:#dc3545"><i class="fas fa-arrow-down"></i> Catat Pengeluaran</a>
            </div>
        </div>
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="background:#f9fafb;color:#0b132b;font-weight:600;">
                    <th style="padding:12px 8px;">Tanggal</th>
                    <th style="padding:12px 8px;">Keterangan</th>
                    <th style="padding:12px 8px;">Jenis</th>
                    <th style="padding:12px 8px;">Jumlah</th>
                    <th style="padding:12px 8px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksis as $t)
                    <tr>
                        <td style="padding:10px 8px;">{{ \Carbon\Carbon::parse($t->tanggal)->format('d/m/Y') }}</td>
                        <td style="padding:10px 8px;">{{ $t->keterangan }}</td>
                        <td style="padding:10px 8px;">{{ $t->jenis }}</td>
                        <td style="padding:10px 8px;">Rp {{ number_format($t->jumlah,0,',','.') }}</td>
                        <td style="padding:10px 8px;">
                            <a href="{{ route('admin.keuangan.edit', $t) }}" title="Edit Transaksi"><i class="fas fa-edit"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" style="padding:10px 8px;">Belum ada transaksi.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
