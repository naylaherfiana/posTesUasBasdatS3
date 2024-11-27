@extends('layouts.app')

@section('title', 'Pelanggan')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Pelanggan</h6>
        </div>
        <div class="card-body">
            <a href= "{{ route('pelanggan.add') }}" class="btn btn-primary mb-3">Tambah Pelanggan</a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($no = 1)
                        @foreach ($pelanggan as $row)
                            <tr>
                                <th>{{ $no++ }}</th>
                                <td>{{ $row->nama_pelanggan }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->alamat }}</td>
                                <td>
                                    <a href= "{{ route('pelanggan.edit', ['id' => $row->id]) }}"
                                        class="btn btn-warning">Edit</a>
                                    <a href= "{{ route('pelanggan.destroy', ['id' => $row->id]) }}"
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
