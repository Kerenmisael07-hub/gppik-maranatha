<?php

namespace App\Http\Controllers;

use App\Models\FinanceReport;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class FinanceReportController extends Controller
{
    public function index()
    {
        $reports = FinanceReport::orderBy('tanggal','desc')->get();
        $total_pemasukan = $reports->where('kategori','Pemasukan')->sum('jumlah');
        $total_pengeluaran = $reports->where('kategori','Pengeluaran')->sum('jumlah');
        $saldo_akhir = $total_pemasukan - $total_pengeluaran;
        return view('finance_reports.index', compact('reports','total_pemasukan','total_pengeluaran','saldo_akhir'));
    }

    public function downloadPDF(Request $request)
    {
        $reports = FinanceReport::orderBy('tanggal','desc')->get();
        $total_pemasukan = $reports->where('kategori','Pemasukan')->sum('jumlah');
        $total_pengeluaran = $reports->where('kategori','Pengeluaran')->sum('jumlah');
        $saldo_akhir = $total_pemasukan - $total_pengeluaran;
        $periode = $reports->min('tanggal') && $reports->max('tanggal') ? $reports->min('tanggal')->format('d/m/Y')." - ".$reports->max('tanggal')->format('d/m/Y') : date('d/m/Y');
        $pdf = Pdf::loadView('finance_reports.pdf', compact('reports','total_pemasukan','total_pengeluaran','saldo_akhir','periode'));
        return $pdf->download('laporan-keuangan-gppik-maranatha.pdf');
    }
}
