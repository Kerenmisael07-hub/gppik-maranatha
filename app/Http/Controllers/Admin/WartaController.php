<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warta;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WartaController extends Controller
{
    public function index()
    {
        $wartas = Warta::orderBy('published_at','desc')->paginate(15);
        return view('admin.warta.index', compact('wartas'));
    }

    public function create()
    {
        return view('admin.warta.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'published_at' => 'nullable|date',
        ]);
        $data['slug'] = Str::slug($data['title']).'-'.time();
        Warta::create($data);
        return redirect()->route('admin.warta.index')->with('success','Warta dibuat.');
    }

    public function edit(Warta $warta)
    {
        return view('admin.warta.edit', compact('warta'));
    }

    public function update(Request $request, Warta $warta)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'published_at' => 'nullable|date',
        ]);
        $warta->update($data);
        return redirect()->route('admin.warta.index')->with('success','Warta diperbarui.');
    }

    public function show(Warta $warta)
    {
        return view('admin.warta.show', compact('warta'));
    }

    public function destroy(Warta $warta)
    {
        $warta->delete();
        return redirect()->route('admin.warta.index')->with('success','Warta dihapus.');
    }
}
