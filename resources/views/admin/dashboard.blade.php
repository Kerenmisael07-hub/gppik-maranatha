@extends('layouts.admin')

@section('content')
    <style>
        /* 
        Developer Note: Customizing the Dashboard
        - To change card colors, modify the CSS variables below (e.g., --color-primary, --color-danger).
        - To add a new card, copy one of the <div class="col-lg-3 col-md-6 mb-4"> blocks. 
          Use the 'stat-card-single' class for a single value, or 'stat-card-double' for two values.
        */
        :root {
            --color-primary: #007bff;
            --color-secondary: #1f2937; /* Dark Navy */
            --color-success: #20c997; /* Teal */
            --color-danger: #e54f6d; /* Red */
            --color-warning: #fd7e14;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .stat-card {
            color: #fff;
            border-radius: 12px;
            padding: 15px; /* Reduced padding */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 140px; /* Reduced height */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: fadeIn 0.5s ease-out forwards;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .stat-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .stat-card-header .icon {
            font-size: 1.3rem; /* Reduced icon size */
            opacity: 0.8;
        }
        .stat-card-header .title {
            font-weight: 600;
            opacity: 0.9;
        }

        .stat-card-body {
            margin-top: 8px; /* Adjusted margin */
        }

        /* Single Value Card */
        .stat-card-single .stat-value {
            font-size: 2rem; /* Reduced font size */
            font-weight: 700;
            margin: 0;
            line-height: 1.2;
        }
        .stat-card-single .stat-label {
            font-size: 0.85rem; /* Reduced font size */
            opacity: 0.9;
            margin: 0;
        }

        /* Double Value Card */
        .stat-card-double .values-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            gap: 15px;
        }
        .stat-card-double .value-block {
            text-align: left;
        }
        .stat-card-double .stat-value {
            font-size: 2.2rem; /* Reduced font size */
            font-weight: 700;
            margin: 0;
            line-height: 1.1;
        }
        .stat-card-double .stat-label {
            font-size: 0.85rem; /* Reduced font size */
            opacity: 0.9;
            margin: 0;
        }

        /* Card Specific Colors */
        .card-pemasukan { background-color: var(--color-success); }
        .card-pengeluaran { background-color: var(--color-danger); }
        .card-jemaat-warta { background-color: var(--color-primary); }
        .card-inventaris { background-color: var(--color-secondary); }

        /* Schedule Table Styles (Unchanged) */
        .schedule-list {
            background: #fff; padding: 25px; border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.05); border: 1px solid #e9ecef;
            animation: fadeIn 0.5s ease-out 0.2s forwards; opacity: 0;
        }
        .schedule-list h3 {
            color:#003a8c; font-weight:700; margin-top: 0;
            margin-bottom: 20px; font-size: 1.4rem;
        }
        .schedule-table { width: 100%; border-collapse: collapse; }
        .schedule-table th, .schedule-table td {
            padding: 15px; text-align: left; border-bottom: 1px solid #f1f3f5; vertical-align: middle;
        }
        .schedule-table th {
            font-weight: 600; font-size: 0.85rem; color: #6c757d;
            text-transform: uppercase; letter-spacing: 0.5px; background-color: #f8f9fa;
        }
        .schedule-table td strong { font-weight: 600; color: #343a40; }
        .schedule-table tbody tr:hover { background-color: #f1f3f5; }
    </style>

    <div class="dashboard-header mb-4">
        <h2 style="color: #003a8c; font-weight: 700;">Dashboard</h2>
        <p style="color: #6c757d;">Selamat datang kembali, Admin! Berikut adalah ringkasan aktivitas gereja.</p>
    </div>

    <div class="row">
        <!-- Card 1: Pemasukan (Single Value) -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="stat-card stat-card-single card-pemasukan" style="margin: 10px;">
                <div class="stat-card-header">
                    <div class="icon"><i class="fas fa-wallet"></i></div>
                </div>
                <div class="stat-card-body">
                    <p class="stat-value">Rp {{ number_format($pemasukanBulanIni, 0, ',', '.') }}</p>
                    <p class="stat-label">Prediksi Pemasukan Bulan Ini</p>
                </div>
            </div>
        </div>

        <!-- Card 2: Jemaat & Warta (Double Value) -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="stat-card stat-card-double card-jemaat-warta" style="margin: 10px;">
                <div class="stat-card-header">
                    <div class="icon"><i class="fas fa-book-open"></i></div>
                </div>
                <div class="stat-card-body">
                    <div class="values-wrapper">
                        <div class="value-block">
                            <p class="stat-value">{{ $totalJemaat }}</p>
                            <p class="stat-label">Jemaat</p>
                        </div>
                        <div class="value-block">
                            <p class="stat-value">{{ $totalWarta }}</p>
                            <p class="stat-label">Warta</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 3: Inventaris (Double Value) -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="stat-card stat-card-double card-inventaris" style="margin: 10px;">
                <div class="stat-card-header">
                    <div class="icon"><i class="fas fa-box"></i></div>
                </div>
                <div class="stat-card-body">
                    <div class="values-wrapper">
                        <div class="value-block">
                            <p class="stat-value">{{ $totalInventaris }}</p>
                            <p class="stat-label">Item</p>
                        </div>
                        <div class="value-block">
                            <p class="stat-value">{{ $totalInventaris }}</p>
                            <p class="stat-label">Inventaris</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Card 4: Pengeluaran (Single Value) -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="stat-card stat-card-single card-pengeluaran" style="margin: 10px;">
                <div class="stat-card-header">
                    <div class="icon"><i class="fas fa-hand-holding-usd"></i></div>
                </div>
                <div class="stat-card-body">
                    <p class="stat-value">Rp {{ number_format($pengeluaranBulanIni, 0, ',', '.') }}</p>
                    <p class="stat-label">Pengeluaran Bulan Ini</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-12">
            <div class="schedule-list">
                <h3>Jadwal Ibadah & Rapat Terdekat</h3>
                <div class="table-responsive">
                    <table class="schedule-table">
                        <thead>
                            <tr>
                                <th>Acara</th>
                                <th>Pelayan Firman</th>
                                <th>Tanggal & Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($jadwalTerdekat as $jadwal)
                                <tr>
                                    <td><strong>{{ $jadwal->jenis_acara }}</strong></td>
                                    <td>{{ $jadwal->pelayan_firman ?? 'N/A' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($jadwal->tanggal_waktu)->format('d M Y, H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center p-4 text-muted">Tidak ada jadwal terdekat.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
