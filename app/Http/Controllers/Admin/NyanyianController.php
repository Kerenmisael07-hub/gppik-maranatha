<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nyanyian;
use Illuminate\Http\Request;

class NyanyianController extends Controller
{
    /**
     * Display a listing of nyanyian (with search and filter)
     */
    public function index(Request $request)
    {
        $query = Nyanyian::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->search($search);
        }

        // Filter by kategori
        if ($request->filled('kategori')) {
            $query->byKategori($request->kategori);
        }

        // Filter by sumber buku
        if ($request->filled('sumber_buku')) {
            $query->bySumberBuku($request->sumber_buku);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $nyanyians = $query->latest()->paginate(15)->withQueryString();
        
        return view('admin.nyanyian.index', compact('nyanyians'));
    }

    /**
     * Show the form for creating a new nyanyian
     */
    public function create()
    {
        return view('admin.nyanyian.create');
    }

    /**
     * Store a newly created nyanyian in storage
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_lagu' => 'required|string|max:50',
            'judul_lagu' => 'required|string|max:255',
            'lirik' => 'required|string',
            'status' => 'required|boolean',
        ], [
            'nomor_lagu.required' => 'Nomor lagu wajib diisi',
            'judul_lagu.required' => 'Judul lagu wajib diisi',
            'lirik.required' => 'Lirik lagu wajib diisi',
        ]);

        // Set default values
        $validated['kategori'] = 'Pujian'; // Default kategori untuk sistem
        $validated['sumber_buku'] = 'NHYK';

        Nyanyian::create($validated);

        return redirect()->route('admin.nyanyian.index')
            ->with('success', 'Lagu berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified nyanyian
     */
    public function edit(Nyanyian $nyanyian)
    {
        return view('admin.nyanyian.edit', compact('nyanyian'));
    }

    /**
     * Update the specified nyanyian in storage
     */
    public function update(Request $request, Nyanyian $nyanyian)
    {
        $validated = $request->validate([
            'nomor_lagu' => 'required|string|max:50',
            'judul_lagu' => 'required|string|max:255',
            'lirik' => 'required|string',
            'status' => 'required|boolean',
        ], [
            'nomor_lagu.required' => 'Nomor lagu wajib diisi',
            'judul_lagu.required' => 'Judul lagu wajib diisi',
            'lirik.required' => 'Lirik lagu wajib diisi',
        ]);

        // Set default values
        $validated['kategori'] = 'Pujian'; // Default kategori untuk sistem
        $validated['sumber_buku'] = 'NHYK';

        $nyanyian->update($validated);

        return redirect()->route('admin.nyanyian.index')
            ->with('success', 'Lagu berhasil diperbarui');
    }

    /**
     * Remove the specified nyanyian from storage
     */
    public function destroy(Nyanyian $nyanyian)
    {
        $nyanyian->delete();

        return redirect()->route('admin.nyanyian.index')
            ->with('success', 'Lagu berhasil dihapus');
    }
}
