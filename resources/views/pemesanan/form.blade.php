@extends('layouts.app')

@section('title', 'Form Pemesanan')

@section('content')
    <form action="{{ isset($pemesanan) ? route('pemesanan.add.update', $pemesanan->id) : route('pemesanan.add.store') }}"
        method="post">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            {{ isset($pemesanan) ? 'Form Edit Pemesanan' : 'Form Tambah Pemesanan' }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="pelanggan_id">Nama Pelanggan</label>
                            <select name="pelanggan_id" id="pelanggan_id" class="custom-select">
                                <option value="" selected disabled hidden>--- Pilih Pelanggan---</option>
                                @foreach ($pelanggan as $row)
                                    <option value="{{ isset($row->id) }}">{{ $row->nama_pelanggan }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div class="form-group">
                            <label for="kategori_id">Kategori</label>
                            <select name="kategori_id" id="kategori_id" class="custom-select">
                                <option value="" selected disabled hidden>--- Pilih Kategori ---</option>
                                @foreach ($kategori as $row)
                                    <option value="{{ $row->id }}">{{ $row->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        <div class="form-group">
                            <label for="barang_id">Barang</label>
                            <select name="barang_id" id="barang_id" class="custom-select">
                                <option value="" selected disabled hidden>--- Pilih Barang---</option>
                                @foreach ($barang as $row)
                                    <option value="{{ isset($row->id) }}">{{ $row->nama_barang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="text" class="form-control @error('stok') is-invalid @enderror" id="jumlah"
                                name="jumlah" value="{{ old('jumlah', isset($pemesanan) ? $pemesanan->jumlah : '') }}">
                            @error('stok')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="diskon_id">Diskon</label>
                            <select name="diskon_id" id="diskon_id" class="custom-select">
                                <option value="" selected hidden>--- Pilih Diskon ---</option>
                                @foreach ($diskon as $row)
                                    <option value="{{ $row->id }}">{{ $row->nama_diskon }} ({{ $row->persentase }}%)
                                    </option>
                                @endforeach
                            </select>
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
