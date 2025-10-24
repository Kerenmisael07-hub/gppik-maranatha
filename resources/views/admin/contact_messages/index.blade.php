@extends('layouts.admin')

@section('content')
<div class="dashboard-module">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px">
        <div>
            <h2>Pesan Masuk</h2>
            <p style="color:#6c757d">Kelola pesan yang masuk dari halaman kontak</p>
        </div>
        @if($unreadCount > 0)
        <div style="background:#dc3545;color:white;padding:8px 16px;border-radius:20px;font-weight:600">
            {{ $unreadCount }} Pesan Belum Dibaca
        </div>
        @endif
    </div>

    @if(session('success'))
    <div class="box" style="background:#d4edda;color:#155724;padding:12px;margin-bottom:16px">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    <div class="box" style="padding:0;overflow:hidden">
        <table style="width:100%;border-collapse:collapse">
            <thead style="background:#f8f9fa">
                <tr>
                    <th style="padding:12px;text-align:left;border-bottom:2px solid #e0e6f1">Status</th>
                    <th style="padding:12px;text-align:left;border-bottom:2px solid #e0e6f1">Nama</th>
                    <th style="padding:12px;text-align:left;border-bottom:2px solid #e0e6f1">Email</th>
                    <th style="padding:12px;text-align:left;border-bottom:2px solid #e0e6f1">Pesan</th>
                    <th style="padding:12px;text-align:left;border-bottom:2px solid #e0e6f1">Tanggal</th>
                    <th style="padding:12px;text-align:center;border-bottom:2px solid #e0e6f1">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $message)
                <tr style="border-bottom:1px solid #e0e6f1;{{ !$message->is_read ? 'background:#f0f9ff' : '' }}">
                    <td style="padding:12px">
                        @if(!$message->is_read)
                            <span style="background:#dc3545;color:white;padding:4px 8px;border-radius:4px;font-size:12px">
                                <i class="fas fa-envelope"></i> Baru
                            </span>
                        @elseif($message->replied_at)
                            <span style="background:#28a745;color:white;padding:4px 8px;border-radius:4px;font-size:12px">
                                <i class="fas fa-check-double"></i> Dibalas
                            </span>
                        @else
                            <span style="background:#6c757d;color:white;padding:4px 8px;border-radius:4px;font-size:12px">
                                <i class="fas fa-eye"></i> Dibaca
                            </span>
                        @endif
                    </td>
                    <td style="padding:12px;font-weight:{{ !$message->is_read ? '600' : 'normal' }}">
                        {{ $message->name }}
                    </td>
                    <td style="padding:12px;color:#6c757d">{{ $message->email }}</td>
                    <td style="padding:12px">{{ Str::limit($message->message, 50) }}</td>
                    <td style="padding:12px;color:#6c757d;font-size:13px">
                        {{ $message->created_at->format('d M Y H:i') }}
                    </td>
                    <td style="padding:12px;text-align:center">
                        <div style="display:flex;gap:4px;justify-content:center">
                            <a href="{{ route('admin.contact_messages.show', $message) }}" 
                               class="action-button" 
                               style="background:#0dcaf0;color:#000;font-size:13px;padding:6px 10px">
                                <i class="fas fa-eye"></i>
                            </a>
                            <form action="{{ route('admin.contact_messages.destroy', $message) }}" 
                                  method="post" 
                                  style="display:inline">
                                @csrf 
                                @method('DELETE')
                                <button class="action-button" 
                                        style="background:#dc3545;font-size:13px;padding:6px 10px" 
                                        onclick="return confirm('Hapus pesan ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding:40px;text-align:center;color:#6c757d">
                        <i class="fas fa-inbox" style="font-size:48px;color:#d1d5db;margin-bottom:12px;display:block"></i>
                        Belum ada pesan masuk
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($messages->hasPages())
    <div style="margin-top:20px">{{ $messages->links() }}</div>
    @endif
</div>
@endsection
