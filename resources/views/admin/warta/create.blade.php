@extends('layouts.admin')

@section('content')
<div class="dashboard-module">
    <h2>Tambah Warta</h2>
    <form method="post" action="{{ route('admin.warta.store') }}">
        @csrf
        <div style="margin:8px 0;"><input type="text" name="title" placeholder="Judul" style="width:100%;padding:10px;border-radius:6px;border:1px solid #ccc"></div>
        <div style="margin:8px 0;"><input type="text" name="excerpt" placeholder="Ringkasan (excerpt)" style="width:100%;padding:10px;border-radius:6px;border:1px solid #ccc"></div>
        <div style="margin:8px 0;"><textarea name="content" rows="8" placeholder="Isi warta" style="width:100%;padding:10px;border-radius:6px;border:1px solid #ccc"></textarea></div>
        <div style="margin:8px 0;"><input type="date" name="published_at" style="padding:10px;border-radius:6px;border:1px solid #ccc"></div>
        <button class="action-button" type="submit">Simpan</button>
    </form>
</div>
@endsection
