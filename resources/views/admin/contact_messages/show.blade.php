@extends('layouts.admin')

@section('content')
<div class="dashboard-module">
    <div style="margin-bottom:20px">
        <a href="{{ route('admin.contact_messages.index') }}" class="action-button" style="background:#6c757d">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Pesan
        </a>
    </div>

    <div class="box">
        <div style="border-bottom:2px solid #e0e6f1;padding-bottom:16px;margin-bottom:20px">
            <h2 style="color:#003a8c;margin-bottom:8px">{{ $contactMessage->name }}</h2>
            <p style="color:#6c757d;font-size:14px">
                <i class="fas fa-envelope"></i> {{ $contactMessage->email }}
            </p>
            <p style="color:#6c757d;font-size:13px;margin-top:4px">
                <i class="fas fa-calendar"></i> {{ $contactMessage->created_at->format('d M Y H:i') }} WIB
            </p>
        </div>

        <div style="margin-bottom:24px">
            <h4 style="color:#102a43;margin-bottom:12px">Pesan:</h4>
            <div style="background:#f8f9fa;padding:16px;border-radius:8px;line-height:1.8;white-space:pre-wrap">{{ $contactMessage->message }}</div>
        </div>

        <div style="border-top:2px solid #e0e6f1;padding-top:16px;display:flex;gap:8px;flex-wrap:wrap">
            @if(!$contactMessage->is_read)
            <form action="{{ route('admin.contact_messages.mark_read', $contactMessage) }}" method="post" style="display:inline">
                @csrf
                <button class="action-button" style="background:#0dcaf0;color:#000">
                    <i class="fas fa-eye"></i> Tandai Sudah Dibaca
                </button>
            </form>
            @endif

            @if(!$contactMessage->replied_at)
            <form action="{{ route('admin.contact_messages.mark_replied', $contactMessage) }}" method="post" style="display:inline">
                @csrf
                <button class="action-button" style="background:#28a745">
                    <i class="fas fa-check"></i> Tandai Sudah Dibalas
                </button>
            </form>
            @else
            <div style="background:#d4edda;color:#155724;padding:8px 16px;border-radius:6px">
                <i class="fas fa-check-circle"></i> Sudah dibalas pada {{ $contactMessage->replied_at->format('d M Y H:i') }}
            </div>
            @endif

            <a href="mailto:{{ $contactMessage->email }}?subject=Re: Pesan dari Website GPPIK&body=Kepada Yth. {{ $contactMessage->name }},%0D%0A%0D%0ATerima kasih atas pesan Anda.%0D%0A%0D%0A" 
               class="action-button" 
               style="background:#003a8c">
                <i class="fas fa-reply"></i> Balas via Email
            </a>

            <form action="{{ route('admin.contact_messages.destroy', $contactMessage) }}" method="post" style="display:inline;margin-left:auto">
                @csrf 
                @method('DELETE')
                <button class="action-button" 
                        style="background:#dc3545" 
                        onclick="return confirm('Hapus pesan ini?')">
                    <i class="fas fa-trash"></i> Hapus Pesan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
