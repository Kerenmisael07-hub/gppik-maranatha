@extends('layouts.admin')

@section('content')
    <h1 style="font-size:2rem;font-weight:700;color:#003a8c;margin-bottom:0.5rem;">Laporan Keuangan Gereja</h1>
    <p style="color:#6b7280;margin-bottom:1.5rem;">Menampilkan data pemasukan dan pengeluaran jemaat gereja.</p>
    <a href="{{ route('admin.finance_reports.downloadPDF') }}" class="action-button" style="background:#0d6efd;margin-bottom:15px;display:inline-block"><i class="fas fa-download"></i> Download PDF</a>
    <div style="background:#fff;border-radius:10px;padding:24px;box-shadow:0 2px 8px rgba(0,0,0,0.04);max-width:1300px;margin-bottom:2rem;">
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="background:#f9fafb;color:#0b132b;font-weight:600;">
                    <th style="padding:12px 8px;">No</th>
                    <th style="padding:12px 8px;">Tanggal</th>
                    <th style="padding:12px 8px;">Keterangan</th>
                    <th style="padding:12px 8px;">Kategori</th>
                    <th style="padding:12px 8px;">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reports as $i => $r)
                <tr>
                    <td style="padding:10px 8px;">{{ $i+1 }}</td>
                    <td style="padding:10px 8px;">{{ \Carbon\Carbon::parse($r->tanggal)->format('d/m/Y') }}</td>
                    <td style="padding:10px 8px;">{{ $r->keterangan }}</td>
                    <td style="padding:10px 8px;">{{ $r->kategori }}</td>
                    <td style="padding:10px 8px;">Rp {{ number_format($r->jumlah,2,',','.') }}</td>
                </tr>
                @empty
                <tr><td colspan="5" style="padding:10px 8px;">Belum ada laporan.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div style="margin-top:20px;font-size:15px;">
            <div style="margin-bottom:5px;"><b>Total Pemasukan:</b> Rp {{ number_format($total_pemasukan,2,',','.') }}</div>
            <div style="margin-bottom:5px;"><b>Total Pengeluaran:</b> Rp {{ number_format($total_pengeluaran,2,',','.') }}</div>
            <div style="margin-bottom:5px;font-weight:600;color:#003a8c;"><b>Saldo Akhir:</b> Rp {{ number_format($saldo_akhir,2,',','.') }}</div>
        </div>
    </div>
@endsection
