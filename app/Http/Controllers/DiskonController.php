<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diskon;

class DiskonController extends Controller
{

    public function dashboard()
    {
        // Hitung jumlah pelanggan
        $jumlahDiskon = Diskon::count();

        // Return view 'dashboard' dengan data jumlah pelanggan
        return view('dashboard', compact('jumlahDiskon'));
    }
    public function index()
    {
        $diskon = Diskon::get();
        return view('diskon.index', ['diskon' => $diskon]);
    }

    public function add(Request $request)
    {
        return view('diskon.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_diskon' => 'required|string|max:50|unique:diskon,nama_diskon',
            'persentase' => 'required|numeric|min:0|max:100',
        ]);

        $diskon = Diskon::create($validated);

        if ($request->ajax()) {
            return response()->json($diskon, 201);
        }

        return redirect()->route('diskon');
    }

    public function show(string $id)
    {
        return Diskon::findOrFail($id);
    }

    public function edit(Request $request, string $id)
    {
        $diskon = Diskon::findOrFail($id);
        return view('diskon.form', ['diskon' => $diskon]);
    }

    public function update(Request $request, string $id)
    {
        $diskon = Diskon::findOrFail($id);
        $validated = $request->validate([
            'nama_diskon' => 'required|string|max:50|unique:diskon,nama_diskon,' . $diskon->id,
            'persentase' => 'required|numeric|min:0|max:100',
        ]);

        $diskon->update($validated);

        if ($request->ajax()) {
            return response()->json($diskon);
        }

        return redirect()->route('diskon');
    }

    public function destroy(string $id)
    {
        $diskon = Diskon::findOrFail($id);
        $diskon->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Diskon berhasil dihapus'], 200);
        }

        return redirect()->route('diskon')->with('success', 'Diskon berhasil dihapus');
    }
}
