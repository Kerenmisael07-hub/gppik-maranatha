<style>
    body { font-family: Arial, sans-serif; }
    .header { text-align: center; font-weight: bold; font-size: 18px; margin-bottom: 10px; }
    .periode { text-align: center; font-size: 14px; margin-bottom: 20px; }
    table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
    th, td { border: 1px solid #333; padding: 6px; font-size: 12px; }
    th { background: #f0f0f0; }
    .summary { font-size: 13px; margin-top: 10px; }
</style>
<div class="header">LAPORAN KEUANGAN GEREJA GPPIK MARANATHA ANTAN</div>
<div class="periode">Periode: {{ $periode }}</div>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Keterangan</th>
            <th>Kategori</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reports as $i => $r)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ \Carbon\Carbon::parse($r->tanggal)->format('d/m/Y') }}</td>
            <td>{{ $r->keterangan }}</td>
            <td>{{ $r->kategori }}</td>
            <td>Rp {{ number_format($r->jumlah,2,',','.') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="summary">
    <div><b>Total Pemasukan:</b> Rp {{ number_format($total_pemasukan,2,',','.') }}</div>
    <div><b>Total Pengeluaran:</b> Rp {{ number_format($total_pengeluaran,2,',','.') }}</div>
    <div><b>Saldo Akhir:</b> Rp {{ number_format($saldo_akhir,2,',','.') }}</div>
</div>
