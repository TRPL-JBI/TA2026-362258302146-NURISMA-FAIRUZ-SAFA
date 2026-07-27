@extends('adminlte::page')

@section('title', 'Verifikasi Pelaku')

@section('content_header')
 <h1 class="font-weight-bold">
        Verifikasi Pelaku Ekraf
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
            Daftar Pengajuan Pelaku Ekraf
        </h3>
    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped">

            <thead class="text-center">

                <tr>
                    <th>No</th>
                    <th>Nama Pemilik</th>
                    <th>Nama Usaha</th>
                    <th>Jenis Pengajuan</th>
                    <th>Subsektor</th>
                    <th>Kecamatan</th>
                    <th>No HP</th>
                    <th>Status</th>
                    <th>Catatan</th>
                    <th width="300">Aksi</th>
                </tr>

            </thead>

            <tbody>

            @forelse($verifikasi as $item)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>{{ $item->user->nama }}</td>

                <td>{{ $item->nama_perusahaan }}</td>

                <td>
    @if($item->jenis_pengajuan === 'baru')
        <span class="badge bg-primary">
            Pendaftaran Baru
        </span>
    @else
        <span class="badge bg-warning text-dark">
            Perubahan Data
        </span>
    @endif
</td>

                <td>{{ $item->subsektor->nama_subsektor }}</td>

                <td>{{ $item->wilayah->kecamatan }}</td>

                <td>{{ $item->nomor_telp }}</td>

                {{-- STATUS --}}
                <td class="text-center">

                    @if($item->status_verifikasi == 'disetujui')

                        <span class="badge bg-success">
                            Disetujui
                        </span>

                    @elseif($item->status_verifikasi == 'ditolak')

                        <span class="badge bg-danger">
                            Ditolak
                        </span>

                    @else

                        <span class="badge bg-warning">
                            Menunggu
                        </span>

                    @endif

                </td>

                {{-- CATATAN --}}
                <td>

                    {{ $item->catatan ?? '-' }}

                </td>

                {{-- AKSI --}}
                <td>

                    @if($item->status_verifikasi == 'menunggu')

                        <div class="d-flex">

                            {{-- APPROVE --}}
                            <form action="{{ route('admin.verifikasi.update',$item->id_verifikasi) }}"
                                  method="POST"
                                  class="mr-2">

                                @csrf
                                @method('PUT')

                                <input
                                    type="hidden"
                                    name="status_verifikasi"
                                    value="disetujui">

                                <button
                                    class="btn btn-success btn-sm">

                                    <i class="fas fa-check"></i>

                                    Approve

                                </button>

                            </form>

                            {{-- REJECT --}}
                            <form action="{{ route('admin.verifikasi.update',$item->id_verifikasi) }}"
                                  method="POST"
                                  style="width:180px;">

                                @csrf
                                @method('PUT')

                                <input
                                    type="hidden"
                                    name="status_verifikasi"
                                    value="ditolak">

                                <textarea
                                    name="catatan"
                                    class="form-control mb-2"
                                    rows="2"
                                    placeholder="Alasan penolakan"></textarea>

                                <button
                                    class="btn btn-danger btn-sm btn-block">

                                    <i class="fas fa-times"></i>

                                    Reject

                                </button>

                            </form>

                        </div>

                    @else

                        <span class="text-success">
                            <i class="fas fa-check-circle"></i>
                            Terverifikasi
                        </span>

                    @endif

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="9" class="text-center">

                    Belum ada data pengajuan.

                </td>

            </tr>

            @endforelse

            </tbody>

        </table>

        <div class="mt-3">

            {{ $verifikasi->links() }}

        </div>

    </div>

</div>

@stop