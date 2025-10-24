<?php

namespace App\Http\Controllers;

use App\Models\Nyanyian;
use Illuminate\Http\Request;

class NyanyianController extends Controller
{
    /**
     * Display a listing of active nyanyian (public page)
     */
    public function index(Request $request)
    {
        $query = Nyanyian::active(); // Hanya tampilkan lagu dengan status = 1 (Aktif)

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

        $nyanyians = $query->orderBy('nomor_lagu', 'asc')->paginate(10)->withQueryString();
        
        // Sumber buku selalu NHYK saja
        $sumberBukuList = Nyanyian::SUMBER_BUKU_OPTIONS;

        return view('public.nhyk.index', compact('nyanyians', 'sumberBukuList'));
    }

    /**
     * Display the specified nyanyian
     */
    public function show(Nyanyian $nyanyian)
    {
        // Hanya tampilkan jika status aktif
        if (!$nyanyian->status) {
            abort(404);
        }

        return view('public.nyanyian.show', compact('nyanyian'));
    }

    /**
     * AJAX endpoint for real-time search and filter
     */
    public function search(Request $request)
    {
        $query = Nyanyian::active();

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        if ($request->filled('kategori')) {
            $query->byKategori($request->kategori);
        }

        if ($request->filled('sumber_buku')) {
            $query->bySumberBuku($request->sumber_buku);
        }

        $nyanyians = $query->orderBy('nomor_lagu', 'asc')->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $nyanyians,
        ]);
    }
}
