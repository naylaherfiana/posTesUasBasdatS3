<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{

    public function dashboard()
    {
        // Hitung jumlah pelanggan
        $jumlahKategori = Kategori::count();

        // Return view 'dashboard' dengan data jumlah pelanggan
        return view('dashboard', compact('jumlahKategori'));
    }
    public function index()
    {
        $kategori = Kategori::get();
        return view('kategori.index', ['kategori' => $kategori]);
    }

    public function add(Request $request)
    {
        return view('kategori.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100',
        ]);

        $kategori = Kategori::create($validated);

        if ($request->ajax()) {
            return response()->json($kategori, 201);
        }

        return redirect()->route('kategori');
    }

    public function show(string $id)
    {
        return Kategori::findOrFail($id);
    }

    public function edit(Request $request, string $id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.form', ['kategori' => $kategori]);
    }

    public function update(Request $request, string $id)
    {
        $kategori = Kategori::findOrFail($id);
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100',
        ]);

        $kategori->update($validated);

        if ($request->ajax()) {
            return response()->json($kategori);
        }

        return redirect()->route('kategori');
    }

    public function destroy(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        if (request()->ajax()) {
            // Respons untuk request AJAX
            return response()->json([
                'success' => true,
                'message' => 'Kategori berhasil dihapus',
            ], 200);
        }

        // Respons untuk request biasa (redirect)
        return redirect()->route('kategori')->with('success', 'Kategori berhasil dihapus');
    }
}
