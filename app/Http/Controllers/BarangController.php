<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;

class BarangController extends Controller
{

    public function dashboard()
    {
        // Hitung jumlah pelanggan
        $jumlahBarang = Barang::count();

        // Return view 'dashboard' dengan data jumlah pelanggan
        return view('dashboard', compact('jumlahBarang'));
    }
    public function index()
    {
        $barang = Barang::get();
        return view('barang.index', ['barang' => $barang]);
    }

    public function add(Request $request)
    {
        $kategori = Kategori::get();
        return view('barang.form', ['kategori' => $kategori]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:100',
            'kategori_id' => 'required|exists:kategori,id',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
        ]);

        $barang = Barang::create($validated);

        if ($request->ajax()) {
            return response()->json($barang, 201);
        }

        return redirect()->route('barang');
    }

    public function show(string $id)
    {
        return Barang::findOrFail($id);
    }

    public function edit(Request $request, string $id)
    {
        $kategori = Kategori::get();
        $barang = Barang::findOrFail($id);
        return view('barang.form', ['barang' => $barang, 'kategori' => $kategori]);
    }

    public function update(Request $request, string $id)
    {
        $barang = Barang::findOrFail($id);
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:100',
            'kategori_id' => 'required|exists:kategori,id',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
        ]);

        $barang->update($validated);

        if ($request->ajax()) {
            return response()->json($barang);
        }

        return redirect()->route('barang');
    }

    public function destroy(string $id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Barang berhasil dihapus'], 200);
        }

        return redirect()->route('barang')->with('success', 'Barang berhasil dihapus');
    }
}
