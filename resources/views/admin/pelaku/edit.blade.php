@extends('adminlte::page')

@section('title', 'Edit Pelaku Ekraf')

@section('content_header')
    <h1>Edit Pelaku Ekraf</h1>
@stop

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Edit Data Pelaku Ekraf</h3>
    </div>

    <form action="{{ route('admin.pelaku.update',$pelaku->id_ekraf) }}" method="POST">

    @csrf
    @method('PUT')

        <div class="card-body">

            <div class="form-group">
                <label>Nama Lengkap</label>
              <input
type="text"
name="nama"
class="form-control"
value="{{ $pelaku->user->nama }}"
required>
            </div>

            <div class="form-group">
                <label>Email</label>
             <input
type="email"
name="email"
class="form-control"
value="{{ $pelaku->user->email }}"
required>
            </div>

           <div class="form-group">
    <label>Nama Perusahaan</label>

    <input
        type="text"
        name="nama_perusahaan"
        class="form-control"
        value="{{ $pelaku->nama_perusahaan }}"
        required>

</div>

            <div class="form-group">
                <label>Alamat</label>
<textarea
name="alamat"
class="form-control"
rows="3"
required>{{ $pelaku->alamat }}</textarea>

            </div>

            <div class="form-group">
                <label>Nomor HP</label>

<input
type="text"
name="nomor_telp"
class="form-control"
value="{{ $pelaku->nomor_telp }}">
            </div>

            <div class="form-group">
                <label>Subsektor</label>

                <select
                    name="id_subsektor"
                    class="form-control">

                    @foreach($subsektor as $item)

                        <option
value="{{ $item->id_subsektor }}"
{{ $pelaku->id_subsektor == $item->id_subsektor ? 'selected' : '' }}>
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

<option
value="{{ $item->id_wilayah }}"
{{ $pelaku->id_wilayah == $item->id_wilayah ? 'selected' : '' }}>

{{ $item->kecamatan }}

</option>

@endforeach

</select>

            </div>

        </div>

        <div class="card-footer">

            <button type="submit" class="btn btn-success">

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