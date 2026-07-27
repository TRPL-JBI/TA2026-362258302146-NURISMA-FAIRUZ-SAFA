@extends('adminlte::page')

@section('title', 'Data Pelaku Ekraf')

@section('content_header')
 <h1 class="font-weight-bold">
        Data Pelaku Ekraf Kabupaten Banyuwangi
    </h1>
@stop

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card">

    <div class="card-header">
        <h3 class="card-title">
            Total Data : {{ $pelaku->total() }}
        </h3>
    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped">

            <thead>

                <tr>
                    <th>No</th>
                    <th>Nama Pemilik</th>
                    <th>Nama Usaha</th>
                    <th>Subsektor</th>
                    <th>Kecamatan</th>
                    <th>No HP</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>

            </thead>

            <tbody>

                @foreach($pelaku as $item)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $item->user->nama }}</td>

                    <td>{{ $item->nama_perusahaan }}</td>

                    <td>{{ $item->subsektor->nama_subsektor }}</td>

                    <td>{{ $item->wilayah->kecamatan }}</td>

                    <td>{{ $item->nomor_telp }}</td>

                   <td>

@if($item->verifikasi)

    @if($item->verifikasi->status_verifikasi == 'disetujui')

        <span class="badge bg-success">
            Disetujui
        </span>

    @elseif($item->verifikasi->status_verifikasi == 'ditolak')

        <span class="badge bg-danger">
            Ditolak
        </span>

    @else

        <span class="badge bg-warning">
            Menunggu
        </span>

    @endif

@else

    <span class="badge bg-secondary">
        Tidak Ada
    </span>

@endif

</td>

                    <td>

                        <span class="badge badge-primary">

                            Data Aktif

                        </span>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

        <div class="mt-3">
            {{ $pelaku->links() }}
        </div>

    </div>

</div>

@stop