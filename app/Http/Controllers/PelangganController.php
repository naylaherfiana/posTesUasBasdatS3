<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;

class PelangganController extends Controller
{
    public function dashboard()
    {
        // Hitung jumlah pelanggan
        $jumlahPelanggan = Pelanggan::count();

        // Return view 'dashboard' dengan data jumlah pelanggan
        return view('dashboard', compact('jumlahPelanggan'));
    }

    public function index()
    {
        $pelanggan = Pelanggan::get();
        return view('pelanggan.index', ['pelanggan' => $pelanggan]);
    }

    public function add(Request $request)
    {
        return view('pelanggan.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:100',
            'email' => 'required|email|unique:pelanggan,email',
            'alamat' => 'nullable|string',
        ]);

        $pelanggan = Pelanggan::create($validated);

        if ($request->ajax()) {
            return response()->json($pelanggan, 201);
        }

        return redirect()->route('pelanggan');
    }

    public function show(string $id)
    {
        return Pelanggan::findOrFail($id);
    }

    public function edit(Request $request, string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pelanggan.form', ['pelanggan' => $pelanggan]);
    }

    public function update(Request $request, string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:100',
            'email' => 'required|email|unique:pelanggan,email,' . $pelanggan->id,
            'alamat' => 'nullable|string',
        ]);

        $pelanggan->update($validated);

        if ($request->ajax()) {
            return response()->json($pelanggan);
        }

        return redirect()->route('pelanggan');
    }

    public function destroy(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Pelanggan berhasil dihapus'], 200);
        }

        return redirect()->route('pelanggan')->with('success', 'Pelanggan berhasil dihapus');
    }
}
