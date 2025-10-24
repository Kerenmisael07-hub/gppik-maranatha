<x-layouts.app :title="'Beranda - GPPIK Maranatha Antan'">
    <section class="page-content">
        <div class="intro" style="display:grid;grid-template-columns:1fr 1fr;gap:36px;align-items:center">
            <div>
                <div class="kicker" style="color:var(--muted);font-size:15px;margin-bottom:14px">Welcome</div>
                <h1 class="title" style="font-size:38px;color:var(--blue-1);margin-bottom:12px">Gereja PPIK Maranatha Antan</h1>
                <div class="subtitle" style="font-weight:700;color:#233142;margin-bottom:18px">GEREJA PPIK MARANATHA ANTAN</div>
                <div class="box">{!! $profile ?? '' !!}</div>
            </div>
            <div class="hero-img" aria-hidden="true">
                <img src="{{ asset('img/Gereja.jpg') }}" alt="foto gereja" />
            </div>
        </div>
    </section>
</x-layouts.app>
