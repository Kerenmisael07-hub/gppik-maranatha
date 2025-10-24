@extends('layouts.admin')

@section('content')
<div class="dashboard-module">
    <div style="display:flex;justify-content:space-between;align-items:center">
        <h3>Inventaris Aset</h3>
        <div style="display:flex;gap:10px;">
            <a href="{{ route('admin.inventaris_aset.exportPdf') }}" class="action-button" style="background:#1e7ae8;color:#fff;display:flex;align-items:center;gap:6px;padding:8px 16px;border-radius:6px;text-decoration:none;">
                <i class="fas fa-download"></i> Download PDF
            </a>
            <a href="{{ route('admin.inventaris_aset.create') }}" class="action-button">Tambah Item</a>
        </div>
    </div>
    <table class="data-table" style="margin-top:12px">
        <thead><tr><th>Nama</th><th>Kuantitas</th><th>Lokasi</th><th>Aksi</th></tr></thead>
        <tbody>
            @forelse($items as $it)
                <tr>
                    <td>{{ $it->nama }}</td>
                    <td>{{ $it->kuantitas }}</td>
                    <td>{{ $it->lokasi }}</td>
                    <td>
                        <a href="{{ route('admin.inventaris_aset.edit',$it) }}" class="action-button" style="background:#0dcaf0;color:#000"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.inventaris_aset.destroy',$it) }}" method="post" style="display:inline">@csrf @method('DELETE')
                            <button class="action-button" style="background:#dc3545" onclick="return confirm('Hapus item?')"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">Belum ada item.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top:12px">{{ $items->links() }}</div>
</div>
@endsection
