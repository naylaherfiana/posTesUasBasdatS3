@extends('layouts.app')

@section('title', 'Form Barang')

@section('content')
    <form action="{{ isset($barang) ? route('barang.add.update', $barang->id) : route('barang.add.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            {{ isset($barang) ? 'Form Edit Barang' : 'Form Tambah Barang' }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="kategori_id">Kategori</label>
                            <select name="kategori_id" id="kategori_id" class="custom-select">
                                <option value="" selected disabled hidden>--- Pilih Kategori---</option>
                                @foreach ($kategori as $row)
                                    <option value="{{ $row->id }}"
                                        {{ old('kategori_id') == $row->id ? 'selected' : '' }}>
                                        {{ $row->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama_barang">Nama Barang</label>
                            <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                                value="{{ isset($barang) ? $barang->nama_barang : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="stok">Stok</label>
                            <input type="number" class="form-control" id="stok" name="stok"
                                value="{{ isset($barang) ? $barang->stok : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Harga</label>
                            <input type="number" class="form-control" id="harga" name="harga"
                                value="{{ isset($barang) ? $barang->harga : '' }}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
