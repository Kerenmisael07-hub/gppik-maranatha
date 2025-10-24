@extends('layouts.admin')

@section('content')
<div class="dashboard-module">
    <h3>Edit Admin</h3>
    <form method="post" action="{{ route('admin.manajemen_admin.update',$user) }}">
        @csrf @method('PUT')
        <div style="margin:8px 0;"><input name="name" value="{{ $user->name }}" placeholder="Nama" style="width:100%"></div>
        <div style="margin:8px 0;"><input name="email" value="{{ $user->email }}" placeholder="Email" style="width:100%"></div>
        <div style="margin:8px 0;"><input name="password" type="password" placeholder="Password (kosongkan jika tidak ingin ganti)" style="width:100%"></div>
        <div style="margin:8px 0;"><input name="password_confirmation" type="password" placeholder="Konfirmasi Password" style="width:100%"></div>
        <button class="action-button">Simpan</button>
    </form>
</div>
@endsection
