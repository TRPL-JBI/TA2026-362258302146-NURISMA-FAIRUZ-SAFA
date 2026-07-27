@extends('adminlte::page')

@section('title', 'Statify Kategori')

@section('content_header')
 <h1 class="font-weight-bold">
        Statify Kategori Pelaku Ekraf
    </h1>
@stop

@section('content')

<div class="row">

    <div class="col-md-4">
        <div class="small-box bg-info">
            <div class="inner">
                <h3 id="totalPelaku">0</h3>
                <p>Total Pelaku</p>
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

</div>

<div class="card">

    <div class="card-header">
 <h2 class="font-weight-bold">
        Kategori Pelaku Ekraf
    </h2>
    </div>

    <div class="card-body">

        <div class="form-group">

            <label>Pilih Subsektor</label>

            <select id="subsektor" class="form-control">

                <option value="">Semua</option>

                @foreach($subsektor as $item)

                    <option value="{{ $item->id_subsektor }}">
                        {{ $item->nama_subsektor }}
                    </option>

                @endforeach

            </select>

        </div>

        <canvas id="chartKategori" height="100"></canvas>

    </div>

</div>

@stop

@section('js')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

let chart;

loadChart();

function loadChart(idSubsektor = '')
{

    fetch('/api/statify?id_subsektor=' + idSubsektor)

    .then(res => res.json())

    .then(data => {

        document.getElementById('totalPelaku').innerHTML =
            data.total_pelaku;

        document.getElementById('totalSubsektor').innerHTML =
            data.total_subsektor;

        let labels = [];
        let jumlah = [];

        data.per_subsektor.forEach(item => {

            labels.push(item.nama_subsektor);

            jumlah.push(item.jumlah);

        });

        if(chart){

            chart.destroy();

        }

        chart = new Chart(

            document.getElementById('chartKategori'),

            {

                type:'bar',

                data:{

                    labels:labels,

                    datasets:[{

                        label:'Jumlah Pelaku',

                        data:jumlah

                    }]

                }

            }

        );

    });

}

document.getElementById('subsektor')

.addEventListener('change',function(){

    loadChart(this.value);

});

</script>

@stop