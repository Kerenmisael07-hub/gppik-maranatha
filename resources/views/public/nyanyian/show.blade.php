@extends('layouts.app')

@section('title', $nyanyian->judul_lagu . ' - ' . $nyanyian->nomor_lagu)

@section('content')
    <div class="container" style="max-width:900px;margin:40px auto;padding:0 20px;">
        <!-- Back Button -->
        <div style="margin-bottom:24px;">
            <a href="{{ route('nyanyian.index') }}" 
               style="display:inline-flex;align-items:center;gap:8px;color:var(--blue-1);text-decoration:none;font-weight:500;">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar
            </a>
        </div>

        <!-- Song Header -->
        <div class="box" style="margin-bottom:24px;">
            <div style="border-bottom:2px solid var(--blue-1);padding-bottom:16px;margin-bottom:20px;">
                <div style="display:flex;align-items:start;justify-content:space-between;gap:16px;flex-wrap:wrap;">
                    <div>
                        <h1 style="margin:0 0 8px 0;color:var(--blue-1);font-size:28px;">
                            {{ $nyanyian->judul_lagu }}
                        </h1>
                        <p style="margin:0;color:var(--muted);font-size:18px;font-weight:500;">
                            {{ $nyanyian->nomor_lagu }}
                        </p>
                    </div>
                    <div style="display:flex;gap:8px;flex-wrap:wrap;">
                        <span class="badge" style="background:#f3e5f5;color:#7b1fa2;padding:6px 12px;border-radius:4px;font-size:14px;">
                            <i class="fas fa-book"></i> {{ $nyanyian->sumber_buku }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Lyrics -->
            <div style="background:#f8f9fa;padding:24px;border-radius:8px;border-left:4px solid var(--blue-1);">
                <h3 style="margin:0 0 16px 0;color:var(--blue-2);font-size:16px;text-transform:uppercase;letter-spacing:1px;">
                    <i class="fas fa-music"></i> Lirik Lagu
                </h3>
                <div style="white-space:pre-wrap;line-height:1.8;font-size:16px;color:#333;font-family:'Times New Roman',serif;">{{ $nyanyian->lirik }}</div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;">
            <button onclick="window.print()" 
                    style="background:var(--blue-1);color:white;border:none;padding:12px 24px;border-radius:6px;cursor:pointer;font-size:16px;display:inline-flex;align-items:center;gap:8px;">
                <i class="fas fa-print"></i> Cetak
            </button>
            <button onclick="copyLyrics()" 
                    style="background:#28a745;color:white;border:none;padding:12px 24px;border-radius:6px;cursor:pointer;font-size:16px;display:inline-flex;align-items:center;gap:8px;">
                <i class="fas fa-copy"></i> Salin Lirik
            </button>
        </div>
    </div>

    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            .box, .box * {
                visibility: visible;
            }
            .box {
                position: absolute;
                left: 0;
                top: 0;
            }
        }
    </style>

    <script>
        function copyLyrics() {
            const lirik = @json($nyanyian->lirik);
            const text = `${@json($nyanyian->judul_lagu)}\n${@json($nyanyian->nomor_lagu)}\n\n${lirik}`;
            
            navigator.clipboard.writeText(text).then(() => {
                alert('Lirik berhasil disalin ke clipboard!');
            }).catch(err => {
                console.error('Gagal menyalin:', err);
                // Fallback method
                const textarea = document.createElement('textarea');
                textarea.value = text;
                document.body.appendChild(textarea);
                textarea.select();
                document.execCommand('copy');
                document.body.removeChild(textarea);
                alert('Lirik berhasil disalin ke clipboard!');
            });
        }
    </script>
@endsection
