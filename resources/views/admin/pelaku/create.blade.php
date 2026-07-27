@extends('adminlte::page')

@section('title', 'Tambah Pelaku Ekraf')

@section('content_header')
    <h1>Tambah Pelaku Ekraf</h1>
@stop

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Form Data Pelaku Ekraf</h3>
    </div>

    <form action="{{ route('admin.pelaku.store') }}" method="POST">

        @csrf

        <div class="card-body">

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input
                    type="text"
                    name="nama"
                    class="form-control"
                    required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input
                    type="email"
                    name="email"
                    class="form-control"
                    required>
            </div>

            <div class="form-group">
                <label>Nama Perusahaan</label>
                <input
                    type="text"
                    name="nama_perusahaan"
                    class="form-control"
                    required>
            </div>

            <div class="form-group">
                <label>Alamat</label>

                <textarea
                    name="alamat"
                    class="form-control"
                    rows="3"
                    required></textarea>

            </div>

            <div class="form-group">
                <label>Nomor HP</label>

                <input
                    type="text"
                    name="nomor_telp"
                    class="form-control">
            </div>

            <div class="form-group">
                <label>Subsektor</label>

                <select
                    name="id_subsektor"
                    class="form-control">

                    @foreach($subsektor as $item)

                        <option value="{{ $item->id_subsektor }}">
                            {{ $item->nama_subsektor }}
                        </option>

                    @endforeach

                </select>

            </div>

            <div class="form-group">
                <label>Kecamatan</label>

                <select
                    name="id_wilayah"
                    class="form-control">

                    @foreach($wilayah as $item)

                        <option value="{{ $item->id_wilayah }}">
                            {{ $item->kecamatan }}
                        </option>

                    @endforeach

                </select>

            </div>

        </div>

        <div class="card-footer">

            <button class="btn btn-success">

                <i class="fas fa-save"></i>

                Simpan

            </button>

            <a
                href="{{ route('admin.pelaku.index') }}"
                class="btn btn-secondary">

                Kembali

            </a>

        </div>

    </form>

</div>

@stop