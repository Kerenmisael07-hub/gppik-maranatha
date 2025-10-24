@props(['title' => null, 'innerContent' => null])
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{ $title ?? 'Admin - GPPIK' }}</title>
	@if(site_setting('favicon'))
		<link rel="icon" href="{{ asset('storage/' . site_setting('favicon')) }}" type="image/x-icon">
		<link rel="shortcut icon" href="{{ asset('storage/' . site_setting('favicon')) }}" type="image/x-icon">
	@endif
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
	<style>
		:root {--blue-1:#003a8c;--blue-2:#0066cc;--muted:#6b7280;--dark:#0b132b;--gray-light:#f0f4ff;}
		*{box-sizing:border-box;margin:0;padding:0}
		body{font-family:Inter,system-ui,-apple-system,Segoe UI,Roboto,"Helvetica Neue",Arial;background:#ffffff;color:#102a43;display:flex;min-height:100vh;overflow:hidden;}
		.sidebar {width: 280px; background: var(--blue-1); color: #fff; display: flex; flex-direction: column; padding: 20px 0; flex-shrink: 0; overflow-y: auto; transition: transform 0.3s ease;}
		.sidebar-logo {display: flex; align-items: center; gap: 10px; padding: 0 20px; margin-bottom: 30px; border-bottom: 1px solid rgba(255, 255, 255, 0.1); padding-bottom: 20px;}
		.sidebar-logo img {width: 40px; height: 40px; border-radius: 50%; object-fit: cover;}
		.sidebar-logo h2 {font-size: 18px; font-weight: 700;}
		.sidebar-heading {color: rgba(255, 255, 255, 0.6); font-size: 12px; padding: 15px 20px 5px; text-transform: uppercase; font-weight: 600; letter-spacing: 0.5px;}
		.sidebar-menu-item {display: flex; align-items: center; gap: 15px; padding: 12px 20px; text-decoration: none; color: #e0e6f1; font-size: 15px; transition: background-color 0.2s, color 0.2s; cursor: pointer;}
		.sidebar-menu-item:hover {background-color: rgba(255, 255, 255, 0.1); color: #fff;}
		.sidebar-menu-item.active {background-color: var(--blue-2); font-weight: 600; color: #fff;}
		.sidebar-menu-item i {width: 20px; text-align: center;}
		.content {flex: 1; display: flex; flex-direction: column; overflow: hidden;}
		.navbar {background: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center; padding: 12px 24px; flex-shrink: 0; border-bottom: 1px solid #eef3fb;}
		.main-content {padding: 24px; flex-grow: 1; overflow-y: auto; max-height: calc(100vh - 60px);}
		.dashboard-module {margin-bottom: 20px; background: #fff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); padding: 18px;}
		.action-button {background: var(--blue-2); color: #fff; border: none; border-radius: 6px; padding: 8px 12px; font-size: 14px; cursor: pointer; display: inline-flex; align-items: center; gap: 5px;}
		.data-table {width: 100%; border-collapse: collapse; margin-top: 10px;}
		.data-table th, .data-table td {padding: 10px; text-align: left; border-bottom: 1px solid #eef3fb;}
		.data-table th {background: #f9fafb; color: var(--dark); font-weight: 600;}
		.text-danger{color:#dc3545}
		.text-success{color:#28a745}
		.mb-2{margin-bottom:8px}
		
		/* Mobile Toggle */
		.sidebar-toggle {display: none; background: var(--blue-2); color: #fff; border: none; padding: 8px 12px; border-radius: 6px; cursor: pointer; font-size: 18px;}
		.sidebar-overlay {display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 998; opacity: 0; transition: opacity 0.3s ease;}
		
		/* Mobile Responsive */
		@media (max-width: 768px) {
			.sidebar {position: fixed; left: 0; top: 0; bottom: 0; z-index: 999; transform: translateX(-100%);}
			.sidebar.open {transform: translateX(0);}
			.sidebar-toggle {display: inline-flex; align-items: center; gap: 8px;}
			.sidebar-overlay.show {display: block; opacity: 1;}
			.main-content {padding: 16px;}
		}
	</style>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	@php($viteManifest = public_path('build/manifest.json'))
	@if (file_exists($viteManifest))
		@vite(['resources/css/app.css','resources/js/app.js'])
	@endif
</head>
<body>
	<!-- Sidebar Overlay (untuk mobile) -->
	<div class="sidebar-overlay" id="sidebarOverlay"></div>
	
	<aside class="sidebar" id="sidebar">
		<div class="sidebar-logo">
			@if(site_setting('logo_website'))
				<img src="{{ asset('storage/' . site_setting('logo_website')) }}" alt="Logo GPPIK">
			@else 
				<img src="{{ asset('img/Gereja.jpg') }}" alt="Logo GPPIK">
			@endif
			<h2>GPPIK Antan</h2>
		</div>

		<a class="sidebar-menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
			<i class="fas fa-tachometer-alt"></i> Dashboard Utama
		</a>

		<div class="sidebar-heading">ADMINISTRASI PUSAT</div>
		<a class="sidebar-menu-item {{ request()->routeIs('admin.jemaat.*') ? 'active' : '' }}" href="{{ route('admin.jemaat.index') }}">
			<i class="fas fa-users"></i> Data Jemaat
		</a>
		<a class="sidebar-menu-item {{ request()->routeIs('admin.jadwal.index') ? 'active' : '' }}" href="{{ route('admin.jadwal.index') }}">
			<i class="fas fa-calendar-alt"></i> Jadwal Ibadah & Rapat
		</a>

		<div class="sidebar-heading">PENATALAYANAN & KEUANGAN</div>
		<a class="sidebar-menu-item {{ request()->routeIs('admin.keuangan.index') ? 'active' : '' }}" href="{{ route('admin.keuangan.index') }}">
			<i class="fas fa-hand-holding-usd"></i> Keuangan Gereja
		</a>
		<a class="sidebar-menu-item {{ request()->routeIs('admin.finance_reports.index') ? 'active' : '' }}" href="{{ route('admin.finance_reports.index') }}">
			<i class="fas fa-file-invoice"></i> Laporan Keuangan
		</a>
		<a class="sidebar-menu-item {{ request()->routeIs('admin.inventaris_aset') ? 'active' : '' }}" href="{{ route('admin.inventaris_aset') }}">
			<i class="fas fa-briefcase"></i> Inventaris Aset
		</a>

		<div class="sidebar-heading">KONTEN DIGITAL</div>
		<a class="sidebar-menu-item {{ request()->routeIs('admin.warta_news') ? 'active' : '' }}" href="{{ route('admin.warta_news') }}">
			<i class="fas fa-newspaper"></i> Warta Jemaat/News
		</a>
		<a class="sidebar-menu-item {{ request()->routeIs('admin.nyanyian.*') ? 'active' : '' }}" href="{{ route('admin.nyanyian.index') }}">
			<i class="fas fa-music"></i> Nyanyian (NHYK)
		</a>
		<a class="sidebar-menu-item {{ request()->routeIs('admin.galeri_foto') ? 'active' : '' }}" href="{{ route('admin.galeri_foto') }}">
			<i class="fas fa-images"></i> Galeri Foto
		</a>
		<a class="sidebar-menu-item {{ request()->routeIs('admin.contact_messages.*') ? 'active' : '' }}" href="{{ route('admin.contact_messages.index') }}" style="display:flex;align-items:center">
			<i class="fas fa-inbox"></i> Pesan Masuk
			@if($unreadMessagesCount > 0)
			<span style="background:#dc3545;color:white;padding:2px 8px;border-radius:10px;font-size:11px;font-weight:700;margin-left:auto">{{ $unreadMessagesCount }}</span>
			@endif
		</a>
		<a class="sidebar-menu-item {{ request()->routeIs('admin.homepage_content.*') ? 'active' : '' }}" href="{{ route('admin.homepage_content.index') }}">
			<i class="fas fa-home"></i> Konten Beranda
		</a>

		<div class="sidebar-heading">SISTEM</div>
		<a class="sidebar-menu-item {{ request()->routeIs('admin.manajemen_admin') ? 'active' : '' }}" href="{{ route('admin.manajemen_admin') }}">
			<i class="fas fa-user-shield"></i> Manajemen Admin
		</a>
		<a class="sidebar-menu-item {{ request()->routeIs('admin.pengaturan_umum') ? 'active' : '' }}" href="{{ route('admin.pengaturan_umum') }}">
			<i class="fas fa-cogs"></i> Pengaturan Umum
		</a>
		<form action="{{ route('logout') }}" method="post" style="margin-top: 20px; padding: 0 18px;">
			@csrf
			<button type="submit" class="sidebar-menu-item" style="background:none;border:none;cursor:pointer;color:#ff6666">
				<i class="fas fa-sign-out-alt"></i> Logout
			</button>
		</form>
	</aside>
	<div class="content">
		<div class="navbar">
			<div class="navbar-left" style="display:flex;align-items:center;gap:12px;">
				<button class="sidebar-toggle" id="sidebarToggle">
					<i class="fas fa-bars"></i>
					<span>Menu</span>
				</button>
				<span>Admin Dashboard</span>
			</div>
			<div class="navbar-right">Hi, Admin</div>
		</div>
		<div class="main-content">
			{{-- Support both component slot and section('content') --}}
			{!! $innerContent ?? $slot ?? '' !!}
		</div>
	</div>
	
	<script>
		// Toggle Sidebar untuk Mobile
		const sidebar = document.getElementById('sidebar');
		const sidebarToggle = document.getElementById('sidebarToggle');
		const sidebarOverlay = document.getElementById('sidebarOverlay');
		
		function toggleSidebar() {
			sidebar.classList.toggle('open');
			sidebarOverlay.classList.toggle('show');
		}
		
		sidebarToggle.addEventListener('click', toggleSidebar);
		sidebarOverlay.addEventListener('click', toggleSidebar);
		
		// Auto close sidebar saat klik menu item di mobile
		const menuItems = document.querySelectorAll('.sidebar-menu-item');
		menuItems.forEach(item => {
			item.addEventListener('click', () => {
				if (window.innerWidth <= 768) {
					toggleSidebar();
				}
			});
		});
	</script>
</body>
</html>
