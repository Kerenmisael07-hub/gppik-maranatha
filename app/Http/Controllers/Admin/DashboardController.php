<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventaris;
use App\Models\Jadwal;
use App\Models\Jemaat;
use App\Models\TransaksiKeuangan;
use App\Models\Warta;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalJemaat = Jemaat::count();
        $totalWarta = Warta::count();
        $totalInventaris = Inventaris::count();

        $pemasukanBulanIni = TransaksiKeuangan::where('jenis', 'Pemasukan')
            ->whereYear('tanggal', Carbon::now()->year)
            ->whereMonth('tanggal', Carbon::now()->month)
            ->sum('jumlah');

        $pengeluaranBulanIni = TransaksiKeuangan::where('jenis', 'Pengeluaran')
            ->whereYear('tanggal', Carbon::now()->year)
            ->whereMonth('tanggal', Carbon::now()->month)
            ->sum('jumlah');

        $jadwalTerdekat = Jadwal::where('tanggal_waktu', '>=', Carbon::today())
            ->orderBy('tanggal_waktu', 'asc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalJemaat',
            'totalWarta',
            'totalInventaris',
            'pemasukanBulanIni',
            'pengeluaranBulanIni',
            'jadwalTerdekat'
        ));
    }
}
