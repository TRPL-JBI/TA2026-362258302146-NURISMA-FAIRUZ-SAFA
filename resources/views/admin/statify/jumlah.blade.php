@extends('adminlte::page')

@section('title','Statify Jumlah Pelaku')

@section('content_header')
 <h1 class="font-weight-bold">
        Statify Jumlah Pelaku Ekraf
    </h1>
@stop

@section('content')

<div class="row">

    <div class="col-md-4">
        <div class="small-box bg-info">
            <div class="inner">
                <h3 id="totalPelaku">0</h3>
                <h2 class="font-weight-bold">
                    <p>Total Pelaku Ekraf</p>
                </h2>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="small-box bg-success">
            <div class="inner">
                <h3 id="totalSubsektor">0</h3>
                <p>Total Subsektor</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3 id="totalKecamatan">0</h3>
                <p>Total Kecamatan</p>
            </div>
        </div>
    </div>

</div>

<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            Jumlah Pelaku per Kecamatan
        </h3>

    </div>

    <div class="card-body">

        <canvas id="chartJumlah"></canvas>

    </div>

</div>

@stop

@section('js')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

fetch('/api/statify')
.then(res => res.json())
.then(data => {

    document.getElementById('totalPelaku').innerHTML =
        data.total_pelaku;

    document.getElementById('totalSubsektor').innerHTML =
        data.total_subsektor;

    document.getElementById('totalKecamatan').innerHTML =
        data.total_kecamatan;

    const labels = data.per_wilayah.map(item => item.kecamatan);

    const jumlah = data.per_wilayah.map(item => item.jumlah);

    new Chart(document.getElementById('chartJumlah'),{

        type:'bar',

        data:{
            labels:labels,
            datasets:[{
                label:'Jumlah Pelaku',
                data:jumlah
            }]
        },

        options:{
            responsive:true,
            scales:{
                y:{
                    beginAtZero:true
                }
            }
        }

    });

});

</script>

@stop