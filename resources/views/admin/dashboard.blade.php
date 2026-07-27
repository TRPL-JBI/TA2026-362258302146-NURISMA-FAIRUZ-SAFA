@extends('adminlte::page')

@section('title','Dashboard Admin')

@section('content_header')
<h1>Dashboard Admin</h1>
@stop

@section('content')

{{-- ========================= --}}
{{-- RINGKASAN VERIFIKASI --}}
{{-- ========================= --}}

<div class="row">

    <div class="col-lg-3">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ $totalPelaku }}</h3>
                <p>Total Pelaku Ekraf</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $menunggu }}</h3>
                <p>Menunggu Verifikasi</p>
            </div>
            <div class="icon">
                <i class="fas fa-clock"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $disetujui }}</h3>
                <p>Disetujui</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $ditolak }}</h3>
                <p>Ditolak</p>
            </div>
            <div class="icon">
                <i class="fas fa-times-circle"></i>
            </div>
        </div>
    </div>

</div>


{{-- ========================= --}}
{{-- MASTER DATA --}}
{{-- ========================= --}}

<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            Statistik Master Data

        </h3>

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-lg-4">

                <div class="small-box bg-info">

                    <div class="inner">

                        <h3>{{ $totalSubsektor }}</h3>

                        <p>Total Subsektor</p>

                    </div>

                    <div class="icon">

                        <i class="fas fa-th-large"></i>

                    </div>

                </div>

            </div>

            <div class="col-lg-4">

                <div class="small-box bg-warning">

                    <div class="inner">

                        <h3>{{ $totalWilayah }}</h3>

                        <p>Total Kecamatan</p>

                    </div>

                    <div class="icon">

                        <i class="fas fa-map-marker-alt"></i>

                    </div>

                </div>

            </div>

            <div class="col-lg-4">

                <div class="small-box bg-secondary">

                    <div class="inner">

                        <h3>{{ $totalUser }}</h3>

                        <p>Total User</p>

                    </div>

                    <div class="icon">

                        <i class="fas fa-user"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- ========================= --}}
{{-- GRAFIK --}}
{{-- ========================= --}}

<div class="row">

    <div class="col-md-6">

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">

                    Pelaku per Subsektor

                </h3>

            </div>

            <div class="card-body">

                <canvas id="chartSubsektor"></canvas>

            </div>

        </div>

    </div>

    <div class="col-md-6">

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">

                    Pelaku per Kecamatan

                </h3>

            </div>

            <div class="card-body">

                <canvas id="chartWilayah"></canvas>

            </div>

        </div>

    </div>

</div>

@stop



@section('js')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

let subsektorLabel = [

@foreach($chartSubsektor as $item)

'{{ $item->nama_subsektor }}',

@endforeach

];

let subsektorJumlah = [

@foreach($chartSubsektor as $item)

{{ $item->jumlah }},

@endforeach

];

new Chart(document.getElementById('chartSubsektor'),{

type:'bar',

data:{

labels:subsektorLabel,

datasets:[{

label:'Jumlah Pelaku',

data:subsektorJumlah,

backgroundColor:'#17a2b8'

}]

},

options:{

responsive:true,

plugins:{

legend:{

display:false

}

}

}

});



let wilayahLabel=[

@foreach($chartWilayah as $item)

'{{ $item->kecamatan }}',

@endforeach

];

let wilayahJumlah=[

@foreach($chartWilayah as $item)

{{ $item->jumlah }},

@endforeach

];

new Chart(document.getElementById('chartWilayah'),{

type:'pie',

data:{

labels:wilayahLabel,

datasets:[{

data:wilayahJumlah,

backgroundColor:[

'#007bff',

'#28a745',

'#ffc107',

'#dc3545',

'#6f42c1',

'#20c997',

'#fd7e14',

'#6610f2',

'#17a2b8',

'#6c757d',

'#ff6384',

'#36a2eb',

'#ffce56',

'#4bc0c0',

'#9966ff',

'#c9cbcf'

]

}]

},

options:{

responsive:true

}

});

</script>

@stop