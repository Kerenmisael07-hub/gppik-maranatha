@extends('layouts.admin')

@section('content')
<div class="dashboard-module">
    <h2>Warta Jemaat</h2>
    <a href="{{ route('admin.warta.create') }}" class="action-button" style="margin-top:10px"><i class="fas fa-plus"></i> Tambah Warta</a>
    <div style="margin-top:12px;">
        <table class="data-table">
            <thead>
                <tr><th>Judul</th><th>Tanggal</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($wartas as $w)
                    <tr>
                        <td>{{ $w->title }}</td>
                        <td>{{ optional($w->published_at)->format('d/m/Y') ?? '-' }}</td>
                        <td>
                            <a href="{{ route('admin.warta.show',$w) }}" class="action-button" style="background:#6c757d"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('admin.warta.edit',$w) }}" class="action-button" style="background:#0dcaf0;color:#000"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.warta.destroy',$w) }}" method="post" style="display:inline">@csrf @method('DELETE')
                                <button class="action-button" style="background:#dc3545" onclick="return confirm('Hapus warta ini?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3">Belum ada warta.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div style="margin-top:12px">{{ $wartas->links() }}</div>
    </div>
</div>
@endsection
