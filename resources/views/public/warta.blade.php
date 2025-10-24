@extends('layouts.app')

@section('title', 'Warta Jemaat')

@section('content')
<div style="max-width: 1200px; margin: 0 auto; padding: 60px 20px 80px;">
    @if($wartas->count() > 0)
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 30px; margin-bottom: 40px;">
            @foreach($wartas as $warta)
                <div style="background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: transform 0.3s, box-shadow 0.3s;"
                     onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 12px 24px rgba(0,0,0,0.15)'"
                     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px rgba(0,0,0,0.1)'">
                    
                    <div style="padding: 24px;">
                        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px; color: #6b7280; font-size: 14px;">
                            <div style="display: flex; align-items: center; gap: 6px;">
                                <i class="far fa-calendar-alt"></i>
                                <span>{{ \Carbon\Carbon::parse($warta->published_at)->isoFormat('DD MMMM YYYY') }}</span>
                            </div>
                        </div>
                        
                        <h3 style="font-size: 1.5rem; font-weight: 700; color: #1f2937; margin-bottom: 12px; line-height: 1.3;">
                            {{ $warta->title }}
                        </h3>
                        
                        @if($warta->excerpt)
                            <p style="color: #6b7280; font-size: 15px; line-height: 1.6; margin-bottom: 20px;">
                                {{ Str::limit($warta->excerpt, 120) }}
                            </p>
                        @endif
                        
                        <a href="{{ route('warta.detail', $warta->slug) }}" 
                           style="display: inline-flex; align-items: center; gap: 8px; color: #667eea; font-weight: 600; text-decoration: none; transition: gap 0.3s;"
                           onmouseover="this.style.gap='12px'" 
                           onmouseout="this.style.gap='8px'">
                            Baca Selengkapnya
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div style="display: flex; justify-content: center;">
            {{ $wartas->links() }}
        </div>
    @else
        <div style="text-align: center; padding: 60px 20px;">
            <i class="far fa-newspaper" style="font-size: 4rem; color: #e5e7eb; margin-bottom: 20px;"></i>
            <p style="color: #6b7280; font-size: 1.1rem;">Belum ada warta yang dipublikasikan.</p>
        </div>
    @endif
</div>
@endsection
