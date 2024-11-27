@extends('layouts.app')

@section('title', 'Pemesanan')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Pemesanan</h6>
        </div>
        <div class="card-body">
            <a href= "{{ route('pemesanan.add') }}" class="btn btn-primary mb-3">Tambah Pemesanan</a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pelanggan</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Diskon</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($no = 1)
                        @foreach ($pemesanan->reverse() as $row)
                            <tr>
                                <th>{{ $no++ }}</th>
                                <td>{{ $row->pelanggan->nama_pelanggan }}</td>
                                <td>{{ $row->barang->nama_barang }}</td>
                                <td>{{ $row->jumlah }}</td>
                                <td>{{ $row->diskon ? $row->diskon->nama_diskon : '-' }}</td>
                                <td>{{ $row->total_harga }}</td>
                                <td>
                                    <a href= "{{ route('pemesanan.edit', ['id' => $row->id]) }}"
                                        class="btn btn-warning">Edit</a>
                                    <a href= "{{ route('pemesanan.destroy', ['id' => $row->id]) }}"
                                        class="btn btn-danger">Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
