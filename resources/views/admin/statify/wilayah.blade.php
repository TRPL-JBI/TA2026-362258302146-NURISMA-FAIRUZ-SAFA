@extends('adminlte::page')

@section('title','Statify Wilayah')

@section('content_header')

<div class="mb-3">

    <h2 class="font-weight-bold">
        Statify Wilayah
    </h2>

    <p class="text-muted mb-0">
        Persebaran Pelaku Ekonomi Kreatif Kabupaten Banyuwangi
    </p>

</div>

@stop


@section('content')

<div class="card shadow-sm">

    <div class="card-body">

        {{-- FILTER SUBSEKTOR --}}

        <div class="subsektor-wrapper">

            <button
                class="btn btn-warning filter-btn active"
                data-id="all">

                Semua

            </button>

            @foreach($subsektor as $item)

                <button
                    class="btn btn-outline-warning filter-btn"
                    data-id="{{ $item->id_subsektor }}">

                    {{ $item->nama_subsektor }}

                </button>

            @endforeach

        </div>

        {{-- MAP --}}

        <div id="map"></div>

    </div>

</div>


{{-- LEGEND --}}

<div class="card shadow-sm mt-3">

    <div class="card-header">

        <b>Legenda Warna Marker</b>

    </div>

    <div class="card-body">

        <div class="row">

            @foreach($subsektor as $item)

            <div class="col-lg-3 col-md-4 col-sm-6 mb-2">

                <span
                    class="legend-dot"
                    style="
                    background:
                    @switch($item->id_subsektor)

                    @case(1) #ff3b30 @break
                    @case(2) #ff9500 @break
                    @case(3) #34c759 @break
                    @case(4) #007aff @break
                    @case(5) #af52de @break
                    @case(6) #5ac8fa @break
                    @case(7) #ff2d55 @break
                    @case(8) #32ade6 @break
                    @case(9) #5856d6 @break
                    @case(10) #ff6482 @break
                    @case(11) #ff3b30 @break
                    @case(12) #007aff @break
                    @case(13) #34c759 @break
                    @case(14) #ff9500 @break
                    @case(15) #af52de @break
                    @case(16) #5ac8fa @break
                    @case(17) #ff2d55 @break

                    @default gray

                    @endswitch
                    ">
                </span>

                {{ $item->nama_subsektor }}

            </div>

            @endforeach

        </div>

    </div>

</div>

@stop

@section('css')

<link
rel="stylesheet"
href="https://unpkg.com/leaflet/dist/leaflet.css">

<style>

/* =========================
   CARD
========================= */

.card{

border:none;

border-radius:18px;

box-shadow:0 5px 15px rgba(0,0,0,.08);

}

.card-header{

background:white;

border-bottom:none;

font-size:18px;

font-weight:700;

padding:18px 22px;

}


/* =========================
   MAP
========================= */

#map{

width:100%;

height:720px;

border-radius:15px;

overflow:hidden;

}


/* =========================
   FILTER SUBSEKTOR
========================= */

.subsektor-wrapper{

display:flex;

gap:10px;

overflow-x:auto;

overflow-y:hidden;

padding-bottom:10px;

margin-bottom:20px;

scrollbar-width:none;

}

.subsektor-wrapper::-webkit-scrollbar{

display:none;

}

.subsektor-wrapper button{

white-space:nowrap;

border-radius:30px;

padding:10px 22px;

font-weight:600;

transition:.25s;

}

.subsektor-wrapper button:hover{

transform:translateY(-2px);

}

.filter-btn.active{

color:white !important;

}


/* =========================
   LEGEND
========================= */

.legend-dot{

display:inline-block;

width:15px;

height:15px;

border-radius:50%;

margin-right:8px;

vertical-align:middle;

border:2px solid white;

box-shadow:0 0 3px rgba(0,0,0,.25);

}


/* =========================
   POPUP
========================= */

.leaflet-popup-content{

margin:14px;

font-size:14px;

line-height:1.6;

}

.popup-title{

font-size:18px;

font-weight:bold;

margin-bottom:8px;

color:#f39c12;

}

.popup-item{

margin-bottom:8px;

}

.popup-label{

font-weight:bold;

display:block;

color:#555;

}


/* =========================
   RESPONSIVE
========================= */

@media(max-width:768px){

#map{

height:550px;

}

.subsektor-wrapper button{

font-size:13px;

padding:8px 16px;

}

}

</style>

@stop

@section('js')

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>

const map = L.map('map').setView(
    [-8.2192,114.3691],
    10
);

L.tileLayer(
'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
{
    attribution:'© OpenStreetMap'
}
).addTo(map);



/*
|--------------------------------------------------------------------------
| WARNA SUBSEKTOR
|--------------------------------------------------------------------------
*/

const warna = {

1:"#ff3b30",
2:"#ff9500",
3:"#34c759",
4:"#007aff",
5:"#af52de",
6:"#5ac8fa",
7:"#ff2d55",
8:"#30b0c7",
9:"#5856d6",
10:"#ff6482",
11:"#ff3b30",
12:"#007aff",
13:"#34c759",
14:"#ff9500",
15:"#af52de",
16:"#5ac8fa",
17:"#ff2d55"

};



/*
|--------------------------------------------------------------------------
| ARRAY MARKER
|--------------------------------------------------------------------------
*/

let markers=[];

let bounds=L.latLngBounds();



/*
|--------------------------------------------------------------------------
| GENERATE MARKER
|--------------------------------------------------------------------------
*/

@foreach($pelaku as $item)

@if($item->lokasi)

{

const warnaMarker = warna[{{ $item->id_subsektor }}] ?? "#007aff";


const icon = L.divIcon({

    className: "",

    iconSize: [12, 12],

    iconAnchor: [6, 6],

    html: `

        <div style="
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: ${warnaMarker};
            border: 2px solid white;
            box-shadow: 0 0 4px rgba(0,0,0,.3);
        "></div>

    `

});


const marker=L.marker(

[
{{ $item->lokasi->latitude }},
{{ $item->lokasi->longitude }}
],

{

icon:icon

}

);


marker.subsektor="{{ $item->id_subsektor }}";


marker.bindPopup(`

<div>

<div class="popup-title">

{{ $item->nama_perusahaan }}

</div>

<div class="popup-item">

<span class="popup-label">

Subsektor

</span>

{{ $item->subsektor->nama_subsektor }}

</div>

<div class="popup-item">

<span class="popup-label">

Kecamatan

</span>

{{ $item->wilayah->kecamatan }}

</div>

<div class="popup-item">

<span class="popup-label">

Alamat

</span>

{{ $item->alamat }}

</div>

<div class="popup-item">

<span class="popup-label">

Telepon

</span>

{{ $item->nomor_telp }}

</div>

</div>

`);


marker.addTo(map);

markers.push(marker);

bounds.extend(marker.getLatLng());

}

@endif

@endforeach



/*
|--------------------------------------------------------------------------
| AUTO FIT BOUNDS
|--------------------------------------------------------------------------
*/

if(markers.length>0){


map.fitBounds(

bounds,

{

padding:[40,40]

}

);

}

/*
|--------------------------------------------------------------------------
| FILTER SUBSEKTOR
|--------------------------------------------------------------------------
*/

document.querySelectorAll(".filter-btn").forEach(function(btn){

    btn.addEventListener("click",function(){

        // Ganti warna tombol aktif
        document.querySelectorAll(".filter-btn").forEach(function(b){

            b.classList.remove("active");
            b.classList.remove("btn-warning");
            b.classList.add("btn-outline-warning");

        });

        this.classList.remove("btn-outline-warning");
        this.classList.add("btn-warning");
        this.classList.add("active");


        let id = this.dataset.id;

        // Hapus semua marker
        markers.forEach(function(marker){

            map.removeLayer(marker);

        });

        let newBounds = L.latLngBounds();

        // Tampilkan marker sesuai filter
        markers.forEach(function(marker){

            if(id==="all" || marker.subsektor===id){

                marker.addTo(map);

                newBounds.extend(marker.getLatLng());

            }

        });

        // Zoom ke marker yang tampil
        if(newBounds.isValid()){

            map.fitBounds(newBounds,{
                padding:[40,40]
            });

        }

    });

});

</script>

@stop