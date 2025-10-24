@extends('layouts.admin')

@section('content')
<div class="dashboard-module">
    <h2>{{ $warta->title }}</h2>
    <p><em>{{ optional($warta->published_at)->format('d/m/Y') ?? '-' }}</em></p>
    <p>{{ $warta->excerpt }}</p>
    <div style="background:#fff;padding:12px;border-radius:6px">{!! nl2br(e($warta->content)) !!}</div>
</div>
@endsection
