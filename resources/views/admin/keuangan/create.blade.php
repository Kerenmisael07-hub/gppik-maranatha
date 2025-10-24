@extends('layouts.admin')

@section('content')
    <h2 style="color:#003a8c;font-weight:700;margin-bottom:1rem;">Catat {{ $jenis }}</h2>
    <form method="post" action="{{ route('admin.keuangan.store') }}" style="max-width:500px;background:#fff;padding:24px;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,0.04);">
        @csrf
        <input type="hidden" name="jenis" value="{{ $jenis }}">
        <div class="mb-2">
            <label>Tanggal</label>
            <input type="date" name="tanggal" value="{{ old('tanggal') }}" required style="width:100%;padding:10px;border:1px solid #e0e6f1;border-radius:6px;">
            @error('tanggal')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-2">
            <label>Keterangan</label>
            <input type="text" name="keterangan" value="{{ old('keterangan') }}" required style="width:100%;padding:10px;border:1px solid #e0e6f1;border-radius:6px;">
            @error('keterangan')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-2">
            <label>Jumlah (Rp)</label>
            <input type="number" name="jumlah" value="{{ old('jumlah') }}" required min="0" style="width:100%;padding:10px;border:1px solid #e0e6f1;border-radius:6px;">
            @error('jumlah')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <button class="action-button" type="submit" style="background:{{ $jenis=='Pemasukan'?'#28a745':'#dc3545' }}"><i class="fas fa-save"></i> Simpan</button>
        <a href="{{ route('admin.keuangan.index') }}" class="action-button" style="background:#6b7280;margin-left:8px;">Batal</a>
    </form>
@endsection
