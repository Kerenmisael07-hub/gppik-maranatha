@extends('layouts.admin')

@section('content')
<div class="dashboard-module">
    <h2>Edit Warta</h2>
    <form method="post" action="{{ route('admin.warta.update', $warta) }}">
        @csrf @method('PUT')
        <div style="margin:8px 0;"><input type="text" name="title" value="{{ $warta->title }}" placeholder="Judul" style="width:100%;padding:10px;border-radius:6px;border:1px solid #ccc"></div>
        <div style="margin:8px 0;"><input type="text" name="excerpt" value="{{ $warta->excerpt }}" placeholder="Ringkasan (excerpt)" style="width:100%;padding:10px;border-radius:6px;border:1px solid #ccc"></div>
        <div style="margin:8px 0;"><textarea name="content" rows="8" placeholder="Isi warta" style="width:100%;padding:10px;border-radius:6px;border:1px solid #ccc">{{ $warta->content }}</textarea></div>
        <div style="margin:8px 0;"><input type="date" name="published_at" value="{{ optional($warta->published_at)->format('Y-m-d') }}" style="padding:10px;border-radius:6px;border:1px solid #ccc"></div>
        <button class="action-button" type="submit">Simpan Perubahan</button>
    </form>
</div>
@endsection
