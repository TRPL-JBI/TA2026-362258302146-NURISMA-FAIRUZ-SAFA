@extends('adminlte::page')

@section('title','Import Data')

@section('content')

<div class="card">

    <div class="card-header">
         <h3 class="font-weight-bold">
        Import Data Pelaku Ekraf
    </h3>
    </div>

    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.import.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="form-group">

                <label>Pilih File Excel</label>

                <input
                    type="file"
                    name="file"
                    class="form-control">

            </div>

            <button class="btn btn-primary mt-3">
                Import
            </button>

        </form>

    </div>

</div>

@stop