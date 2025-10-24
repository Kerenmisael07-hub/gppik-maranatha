@if ($paginator->hasPages())
    <nav class="pagination-nav" style="display:flex;justify-content:center;align-items:center;gap:8px;">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span style="padding:8px 16px;background:#f1f5f9;color:#94a3b8;border-radius:6px;cursor:not-allowed;">
                <i class="fas fa-chevron-left"></i>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" 
               style="padding:8px 16px;background:var(--blue-2);color:#fff;border-radius:6px;text-decoration:none;transition:background 0.2s;"
               onmouseover="this.style.background='#0052a3'" 
               onmouseout="this.style.background='var(--blue-2)'">
                <i class="fas fa-chevron-left"></i>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span style="padding:8px 16px;color:#64748b;">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span style="padding:8px 16px;background:var(--blue-2);color:#fff;border-radius:6px;font-weight:600;">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}" 
                           style="padding:8px 16px;background:#f1f5f9;color:#64748b;border-radius:6px;text-decoration:none;transition:all 0.2s;"
                           onmouseover="this.style.background='#e2e8f0';this.style.color='#1e293b';" 
                           onmouseout="this.style.background='#f1f5f9';this.style.color='#64748b';">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" 
               style="padding:8px 16px;background:var(--blue-2);color:#fff;border-radius:6px;text-decoration:none;transition:background 0.2s;"
               onmouseover="this.style.background='#0052a3'" 
               onmouseout="this.style.background='var(--blue-2)'">
                <i class="fas fa-chevron-right"></i>
            </a>
        @else
            <span style="padding:8px 16px;background:#f1f5f9;color:#94a3b8;border-radius:6px;cursor:not-allowed;">
                <i class="fas fa-chevron-right"></i>
            </span>
        @endif
    </nav>
@endif