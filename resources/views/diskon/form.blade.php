@extends('layouts.app')

@section('title', 'Form Diskon')

@section('content')
    <form action="{{ isset($diskon) ? route('diskon.add.update', $diskon->id) : route('diskon.add.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            {{ isset($diskon) ? 'Form Edit Diskon' : 'Form Tambah Diskon' }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama_diskon">Nama Diskon</label>
                            <input type="text" class="form-control" id="nama_diskon" name="nama_diskon"
                                value="{{ isset($diskon) ? $diskon->nama_diskon : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="nama_diskon">Persentase</label>
                            <input type="number" class="form-control" id="persentase" name="persentase"
                                value="{{ isset($diskon) ? $diskon->persentase : '' }}">
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
