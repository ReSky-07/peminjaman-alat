<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminAlatController extends Controller
{
    public function index()
    {
        $alats = Alat::with('kategori')->get();
        return view('admin.alat.index', compact('alats'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.alat.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_alat' => 'required',
            'kategori_id' => 'required',
            'stok' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('alat', 'public');
        }

        Alat::create($data);

        return redirect()->route('admin.alat.index')
            ->with('success', 'Alat berhasil ditambahkan');
    }

    public function edit(Alat $alat)
    {
        $kategoris = Kategori::all();
        return view('admin.alat.edit', compact('alat', 'kategoris'));
    }

    public function update(Request $request, Alat $alat)
    {
        $request->validate([
            'nama_alat' => 'required',
            'kategori_id' => 'required',
            'stok' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($alat->gambar && Storage::disk('public')->exists($alat->gambar)) {
                Storage::disk('public')->delete($alat->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('alat', 'public');
        }

        $alat->update($data);

        return redirect()->route('admin.alat.index')
            ->with('success', 'Alat berhasil diupdate');
    }

    public function destroy(Alat $alat)
    {
        if ($alat->gambar && Storage::disk('public')->exists($alat->gambar)) {
            Storage::disk('public')->delete($alat->gambar);
        }

        $alat->delete();

        return back()->with('success', 'Alat berhasil dihapus');
    }
}
