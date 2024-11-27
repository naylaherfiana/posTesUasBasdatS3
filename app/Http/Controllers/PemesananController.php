<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Barang;
use App\Models\Pelanggan;
use App\Models\Diskon;
use App\Models\Kategori;

class PemesananController extends Controller
{

    public function dashboard()
    {
        // Hitung jumlah pelanggan
        $jumlahPemesanan = Pemesanan::count();

        // Return view 'dashboard' dengan data jumlah pelanggan
        return view('dashboard', compact('jumlahPemesanan'));
    }

    public function index()
    {
        $pemesanan = Pemesanan::get();
        return view('pemesanan.index', ['pemesanan' => $pemesanan]);
    }

    public function add()
    {
        $pelanggan = Pelanggan::all();
        $barang = Barang::all();
        $diskon = Diskon::all();
        $kategori = Kategori::all();

        return view('pemesanan.form', [
            'pelanggan' => $pelanggan,
            'barang' => $barang,
            'kategori' => $kategori,
            'diskon' => $diskon
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'barang_id' => 'required|exists:barang,id',
            'jumlah' => 'required|integer|min:1',
            'diskon_id' => 'nullable|exists:diskon,id',
        ]);

        // Ambil data barang
        $barang = Barang::findOrFail($validated['barang_id']);

        // Periksa stok barang cukup
        if ($barang->stok < $validated['jumlah']) {
            return back()->withErrors(['stok' => 'Stok barang tidak mencukupi'])->withInput();
        }

        // Hitung total harga
        $totalHarga = $barang->harga * $validated['jumlah'];

        // Terapkan diskon jika ada
        if ($validated['diskon_id']) {
            $diskon = Diskon::find($validated['diskon_id']);
            if ($diskon) {
                $diskonPersentase = $diskon->persentase ?? 0; // Ambil persentase diskon
                if ($diskonPersentase > 0) {
                    $totalHarga -= ($diskonPersentase / 100) * $totalHarga; // Terapkan diskon
                }
            }
        }

        // Kurangi stok barang
        $barang->stok -= $validated['jumlah'];
        $barang->save();

        // Tambahkan total_harga ke validasi
        $validated['total_harga'] = $totalHarga;

        // Buat pemesanan
        $pemesanan = Pemesanan::create($validated);

        if ($request->ajax()) {
            return response()->json($pemesanan, 201);
        }

        return redirect()->route('pemesanan');
    }


    public function show(string $id)
    {
        $pemesanan = Pemesanan::with(['barang', 'pelanggan', 'diskon'])->findOrFail($id);
        return view('pemesanan.show', ['pemesanan' => $pemesanan]);
    }

    public function edit(string $id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pelanggan = Pelanggan::all();
        $barang = Barang::all();
        $diskon = Diskon::all();

        return view('pemesanan.form', [
            'pemesanan' => $pemesanan,
            'pelanggan' => $pelanggan,
            'barang' => $barang,
            'diskon' => $diskon
        ]);
    }

    public function update(Request $request, string $id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        $validated = $request->validate([
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'barang_id' => 'required|exists:barang,id',
            'jumlah' => 'required|integer|min:1',
            'diskon_id' => 'nullable|exists:diskon,id',
        ]);

        // Ambil data barang lama dan baru
        $barangLama = Barang::findOrFail($pemesanan->barang_id);
        $barangBaru = Barang::findOrFail($validated['barang_id']);

        // Kembalikan stok barang lama
        $barangLama->stok += $pemesanan->jumlah;
        $barangLama->save();

        // Periksa stok barang baru cukup
        if ($barangBaru->stok < $validated['jumlah']) {
            return back()->withErrors(['stok' => 'Stok barang tidak mencukupi'])->withInput();
        }

        // Hitung total harga baru
        $totalHarga = $barangBaru->harga * $validated['jumlah'];

        // Terapkan diskon jika ada
        $diskonId = data_get($validated, 'diskon_id', null);
        if ($diskonId) {
            $diskon = Diskon::find($diskonId);
            if ($diskon) {
                $diskonPersentase = $diskon->persentase ?? 0; // Ambil persentase diskon
                if ($diskonPersentase > 0) {
                    $totalHarga -= ($diskonPersentase / 100) * $totalHarga; // Terapkan diskon
                }
            }
        }


        // Kurangi stok barang baru
        $barangBaru->stok -= $validated['jumlah'];
        $barangBaru->save();

        // Tambahkan total_harga ke validasi
        $validated['total_harga'] = $totalHarga;

        // Perbarui pemesanan
        $pemesanan->update($validated);

        if ($request->ajax()) {
            return response()->json($pemesanan);
        }

        return redirect()->route('pemesanan');
    }


    public function destroy(string $id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        // Kembalikan stok barang
        $barang = Barang::findOrFail($pemesanan->barang_id);
        $barang->stok += $pemesanan->jumlah;
        $barang->save();

        $pemesanan->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Pemesanan berhasil dihapus'], 200);
        }

        return redirect()->route('pemesanan')->with('success', 'Pemesanan berhasil dihapus');
    }
}
