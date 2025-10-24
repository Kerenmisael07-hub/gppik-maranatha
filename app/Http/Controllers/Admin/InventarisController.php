<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventaris;
use Illuminate\Http\Request;

class InventarisController extends Controller
{
    public function index()
    {
        $items = Inventaris::orderBy('nama')->paginate(20);
        return view('admin.inventaris.index', compact('items'));
    }

    public function create()
    {
        return view('admin.inventaris.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'kuantitas' => 'required|integer|min:1',
            'lokasi' => 'nullable|string',
            'nomor_serial' => 'nullable|string',
        ]);
        Inventaris::create($data);
        return redirect()->route('admin.inventaris_aset')->with('success','Item inventaris ditambah.');
    }

    public function edit(Inventaris $inventari)
    {
        return view('admin.inventaris.edit', ['item'=>$inventari]);
    }

    public function update(Request $request, Inventaris $inventari)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'kuantitas' => 'required|integer|min:1',
            'lokasi' => 'nullable|string',
            'nomor_serial' => 'nullable|string',
        ]);
        $inventari->update($data);
        return redirect()->route('admin.inventaris_aset')->with('success','Item diperbarui.');
    }

    public function destroy(Inventaris $inventari)
    {
        $inventari->delete();
        return redirect()->route('admin.inventaris_aset')->with('success','Item dihapus.');
    }

    public function exportPdf()
    {
        $items = Inventaris::orderBy('nama')->get();
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.inventaris.pdf', compact('items'));
        return $pdf->download('inventaris-aset.pdf');
    }
}
