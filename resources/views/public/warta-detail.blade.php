@extends('layouts.app')

@section('title', $warta->title)

@section('content')
<div style="max-width: 900px; margin: 0 auto; padding: 40px 20px 80px;">
    <!-- Breadcrumb -->
    <div style="margin-bottom: 30px;">
        <a href="{{ route('warta') }}" style="color: #667eea; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; font-weight: 500;">
            <i class="fas fa-arrow-left"></i> Kembali ke Warta Jemaat
        </a>
    </div>
    
    <!-- Article Header -->
    <article style="background: #fff; border-radius: 12px; padding: 40px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <div style="margin-bottom: 24px;">
            <div style="display: flex; align-items: center; gap: 12px; color: #6b7280; font-size: 14px; margin-bottom: 16px;">
                <div style="display: flex; align-items: center; gap: 6px;">
                    <i class="far fa-calendar-alt"></i>
                    <span>{{ \Carbon\Carbon::parse($warta->published_at)->isoFormat('dddd, DD MMMM YYYY') }}</span>
                </div>
            </div>
            
            <h1 style="font-size: 2.5rem; font-weight: 700; color: #1f2937; line-height: 1.2; margin-bottom: 20px;">
                {{ $warta->title }}
            </h1>
            
            @if($warta->excerpt)
                <p style="font-size: 1.2rem; color: #6b7280; font-style: italic; line-height: 1.6;">
                    {{ $warta->excerpt }}
                </p>
            @endif
        </div>
        
        <hr style="border: none; border-top: 2px solid #e5e7eb; margin: 30px 0;">
        
        <!-- Article Content -->
        <div style="color: #374151; font-size: 1.05rem; line-height: 1.8;">
            {!! nl2br(e($warta->content)) !!}
        </div>
    </article>
    
    <!-- Latest Warta -->
    @if($latest->count() > 0)
        <div style="margin-top: 60px;">
            <h2 style="font-size: 1.8rem; font-weight: 700; color: #1f2937; margin-bottom: 24px;">
                Warta Lainnya
            </h2>
            
            <div style="display: grid; gap: 20px;">
                @foreach($latest as $item)
                    <a href="{{ route('warta.detail', $item->slug) }}" 
                       style="background: #fff; border-radius: 12px; padding: 20px; display: flex; gap: 20px; text-decoration: none; box-shadow: 0 2px 4px rgba(0,0,0,0.1); transition: transform 0.3s, box-shadow 0.3s;"
                       onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.15)'"
                       onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.1)'">
                        
                        <div style="flex: 1;">
                            <div style="color: #6b7280; font-size: 13px; margin-bottom: 8px;">
                                <i class="far fa-calendar-alt"></i>
                                {{ \Carbon\Carbon::parse($item->published_at)->isoFormat('DD MMM YYYY') }}
                            </div>
                            
                            <h3 style="font-size: 1.1rem; font-weight: 600; color: #1f2937; margin-bottom: 8px;">
                                {{ $item->title }}
                            </h3>
                            
                            @if($item->excerpt)
                                <p style="color: #6b7280; font-size: 14px;">
                                    {{ Str::limit($item->excerpt, 100) }}
                                </p>
                            @endif
                        </div>
                        
                        <div style="display: flex; align-items: center;">
                            <i class="fas fa-chevron-right" style="color: #667eea;"></i>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
