@extends('layouts.admin')

@section('content')
<div class="dashboard-module">
    <h3>Buat Admin Baru</h3>
    <form method="post" action="{{ route('admin.manajemen_admin.store') }}">
        @csrf
        <div style="margin:8px 0;"><input name="name" placeholder="Nama" style="width:100%"></div>
        <div style="margin:8px 0;"><input name="email" placeholder="Email" style="width:100%"></div>
        <div style="margin:8px 0;"><input name="password" type="password" placeholder="Password" style="width:100%"></div>
        <div style="margin:8px 0;"><input name="password_confirmation" type="password" placeholder="Konfirmasi Password" style="width:100%"></div>
        <button class="action-button">Simpan</button>
    </form>
</div>
@endsection
