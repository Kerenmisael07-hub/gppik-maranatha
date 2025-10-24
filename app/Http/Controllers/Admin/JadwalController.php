<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::orderBy('tanggal_waktu')->get();
        return view('admin.jadwal.index', compact('jadwals'));
    }

    public function create()
    {
        return view('admin.jadwal.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tanggal_waktu' => 'required|date',
            'jenis_acara' => 'required|string|max:100',
            'pelayan_firman' => 'nullable|string|max:100',
        ]);
        Jadwal::create($data);
        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan');
    }

    public function edit(Jadwal $jadwal)
    {
        return view('admin.jadwal.edit', compact('jadwal'));
    }

    public function update(Request $request, Jadwal $jadwal)
    {
        $data = $request->validate([
            'tanggal_waktu' => 'required|date',
            'jenis_acara' => 'required|string|max:100',
            'pelayan_firman' => 'nullable|string|max:100',
        ]);
        $jadwal->update($data);
        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil diperbarui');
    }

    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();
        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal dihapus');
    }

    public function exportPdf()
    {
        $jadwals = Jadwal::orderBy('tanggal_waktu')->get();
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.jadwal.pdf', compact('jadwals'));
        return $pdf->download('jadwal-ibadah-rapat.pdf');
    }
}
