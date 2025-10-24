<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jemaat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class JemaatController extends Controller
{
    public function index(Request $request)
    {
        $q = trim($request->input('q', ''));
        $status = $request->input('status');
        $sektor = $request->input('sektor');

        $query = Jemaat::query();
        if ($q !== '') {
            $query->where('nama_lengkap', 'like', "%$q%");
            if (Schema::hasColumn('jemaats', 'sektor')) {
                $query->orWhere('sektor', 'like', "%$q%");
            }
        }
        if ($status && in_array($status, ['Sudah Baptis','Belum Baptis'])) {
            $query->where('status_baptis', $status);
        }
        if ($sektor && $sektor !== 'all' && Schema::hasColumn('jemaats', 'sektor')) {
            $query->where('sektor', $sektor);
        }

        $jemaats = $query->orderBy('nama_lengkap')->paginate(10)->withQueryString();
        $sektors = Schema::hasColumn('jemaats', 'sektor')
            ? Jemaat::select('sektor')->whereNotNull('sektor')->distinct()->pluck('sektor')->toArray()
            : [];

        return view('admin.jemaat.index', compact('jemaats','q','status','sektor','sektors'));
    }

    public function create()
    {
        return view('admin.jemaat.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'tgl_lahir' => 'nullable|date',
            'status_baptis' => 'required|in:Sudah Baptis,Belum Baptis',
            'status_sidi' => 'required|in:Sudah Sidi,Belum Sidi',
            'sektor' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
            'pekerjaan' => 'nullable|string|max:100',
            'keluarga' => 'nullable|string|max:100',
        ]);
        Jemaat::create($data);
        return redirect()->route('admin.jemaat.index')->with('success', 'Jemaat berhasil ditambahkan');
    }

    public function edit(Jemaat $jemaat)
    {
        return view('admin.jemaat.edit', compact('jemaat'));
    }

    public function update(Request $request, Jemaat $jemaat)
    {
        $data = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'tgl_lahir' => 'nullable|date',
            'status_baptis' => 'required|in:Sudah Baptis,Belum Baptis',
            'status_sidi' => 'required|in:Sudah Sidi,Belum Sidi',
            'sektor' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
            'pekerjaan' => 'nullable|string|max:100',
            'keluarga' => 'nullable|string|max:100',
        ]);
        $jemaat->update($data);
        return redirect()->route('admin.jemaat.index')->with('success', 'Jemaat berhasil diperbarui');
    }

    public function destroy(Jemaat $jemaat)
    {
        $jemaat->delete();
        return redirect()->route('admin.jemaat.index')->with('success', 'Jemaat dihapus');
    }
}
