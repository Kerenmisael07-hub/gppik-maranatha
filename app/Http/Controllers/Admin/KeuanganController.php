<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TransaksiKeuangan;
use App\Models\FinanceReport;

class KeuanganController extends Controller
{
    public function index()
    {
        $transaksis = TransaksiKeuangan::orderBy('tanggal','desc')->get();
        return view('admin.keuangan.index', compact('transaksis'));
    }

    public function create($jenis)
    {
        return view('admin.keuangan.create', compact('jenis'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required|string|max:255',
            'jenis' => 'required|in:Pemasukan,Pengeluaran',
            'jumlah' => 'required|integer|min:0',
        ]);
        
        // Simpan ke transaksi_keuangans
        TransaksiKeuangan::create($data);
        
        // Sinkronisasi ke finance_reports
        FinanceReport::create([
            'tanggal' => $data['tanggal'],
            'keterangan' => $data['keterangan'],
            'kategori' => $data['jenis'], // jenis => kategori
            'jumlah' => $data['jumlah'],
        ]);
        
        return redirect()->route('admin.keuangan.index')->with('success', 'Transaksi berhasil dicatat');
    }

    public function edit(TransaksiKeuangan $transaksi)
    {
        return view('admin.keuangan.edit', compact('transaksi'));
    }

    public function update(Request $request, TransaksiKeuangan $transaksi)
    {
        $data = $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required|string|max:255',
            'jenis' => 'required|in:Pemasukan,Pengeluaran',
            'jumlah' => 'required|integer|min:0',
        ]);
        
        // Simpan data lama untuk mencari di finance_reports
        $tanggal_lama = $transaksi->tanggal;
        $keterangan_lama = $transaksi->keterangan;
        
        $transaksi->update($data);
        
        // Sinkronisasi update ke finance_reports
        FinanceReport::where('tanggal', $tanggal_lama)
                     ->where('keterangan', $keterangan_lama)
                     ->update([
                         'tanggal' => $data['tanggal'],
                         'keterangan' => $data['keterangan'],
                         'kategori' => $data['jenis'],
                         'jumlah' => $data['jumlah'],
                     ]);
        
        return redirect()->route('admin.keuangan.index')->with('success', 'Transaksi berhasil diperbarui');
    }

    public function destroy(TransaksiKeuangan $transaksi)
    {
        // Hapus juga dari finance_reports
        FinanceReport::where('tanggal', $transaksi->tanggal)
                     ->where('keterangan', $transaksi->keterangan)
                     ->delete();
        
        $transaksi->delete();
        return redirect()->route('admin.keuangan.index')->with('success', 'Transaksi dihapus');
    }
}
