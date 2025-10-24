@extends('layouts.admin')

@section('content')
<div class="dashboard-module">
    <div style="display:flex;justify-content:space-between;align-items:center">
        <h3>Manajemen Admin</h3>
        <a href="{{ route('admin.manajemen_admin.create') }}" class="action-button">Tambah Admin</a>
    </div>
    <table class="data-table" style="margin-top:12px">
        <thead><tr><th>Nama</th><th>Email</th><th>Aksi</th></tr></thead>
        <tbody>
            @forelse($users as $u)
                <tr>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>
                        <a href="{{ route('admin.manajemen_admin.edit',$u) }}" class="action-button" style="background:#0dcaf0;color:#000"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.manajemen_admin.destroy',$u) }}" method="post" style="display:inline">@csrf @method('DELETE')
                            <button class="action-button" style="background:#dc3545" onclick="return confirm('Hapus admin?')"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3">Belum ada admin.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top:12px">{{ $users->links() }}</div>
</div>
@endsection
