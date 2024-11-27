@extends('layouts.app')

@section('title', 'Diskon')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Diskon</h6>
        </div>
        <div class="card-body">
            <a href= "{{ route('diskon.add') }}" class="btn btn-primary mb-3">Tambah Diskon</a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Diskon</th>
                            <th>Persentase</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($no = 1)
                        @foreach ($diskon as $row)
                            <tr>
                                <th>{{ $no++ }}</th>
                                <td>{{ $row->nama_diskon }}</td>
                                <td>{{ $row->persentase }}</td>
                                <td>
                                    <a href= "{{ route('diskon.edit', ['id' => $row->id]) }}"
                                        class="btn btn-warning">Edit</a>
                                    <a href= "{{ route('diskon.destroy', ['id' => $row->id]) }}"
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
