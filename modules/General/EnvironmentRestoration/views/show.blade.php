@extends('home')

@section('cont')

<kbd><a href="/approval-item/showRequests" class="text-white font-weight-bolder"><i class="fas fa-chevron-left"></i></i> BACK</a></kbd>
<hr>
<div class="container">
    <dl class="row">
        <dt class="col-sm-3">Title:</dt>
        <dd class="col-sm-9">{{$restoration->title}}</dd>

        <dt class="col-sm-3">Category:</dt>
        <dd class="col-sm-9">Environment Restoration Project</dd>

        <dt class="col-sm-3">Restoration Type:</dt>
        <dd class="col-sm-9">{{$restoration->Environment_Restoration_Activity->title}}</dd>

        <dt class="col-sm-3">Ecosystem :</dt>
        <dd class="col-sm-9">{{$restoration->ecosystems_type->type}}</dd>

        <dt class="col-sm-3">Governing Organizations:</dt>
        <dd class="col-sm-9">
            <ul class="list-unstyled">
                @foreach($govorgs as $govorg)
                @switch($govorg)
                @case(1)
                <li>Reforest Sri Lanka</li>
                @break
                @case(2)
                <li>Ministry of Environment</li>
                @break
                @case(3)
                <li>Central Environmental Authority</li>
                @break
                @case(4)
                <li>Ministry of Wildlife</li>
                @break
                @case(5)
                <li>Road Development Authority</li>
                @break
                @endswitch
                @endforeach
            </ul>
        </dd>

        <dt class="col-sm-3">Land Parcel:</dt>
        <dd class="col-sm-9">{{$land[0]->title}}</dd>

        <dt class="col-sm-3">Status:</dt>
        <dd class="col-sm-9">{{$restoration->Status->type}}</dd>

        <dt class="col-sm-3">Created at:</dt>
        <dd class="col-sm-9">{{$restoration->created_at}}</dd>
    </dl>

    <dl class="row">
        <dt class="col-sm-3">Restored Tree Species</dt>
        @if($species==null)
            <dd class="col-sm-12">No restored species specified in the request made</dd>
        @else 
        <dd class="col-sm-7">

            @foreach($species as $individualSpecies)
                <dl class="row">
                <dt class="col-sm-3">Common Name:</dt>
                <dd class="col-sm-9">{{$individualSpecies->Species->title}}</dd>

                <dt class="col-sm-3">Scientific Name:</dt>
                <dd class="col-sm-9">{{$individualSpecies->Species->scientefic_name}}</dd>

                <dt class="col-sm-3">Height:</dt>
                <dd class="col-sm-9">{{$individualSpecies->height}}</dd>

                <dt class="col-sm-3">Dimensions:</dt>
                <dd class="col-sm-9">{{$individualSpecies->dimensions}}</dd>

                <dt class="col-sm-3">Quantity:</dt>
                <dd class="col-sm-9">{{$individualSpecies->quantity}}</dd>

                <dt class="col-sm-3">Remarks:</dt>
                @if($individualSpecies->remarks!=null)
                    <dd class="col-sm-9">{{$individualSpecies->remarks}}</dd>
                @else
                    <dd class="col-sm-9">No remarks specified</dd>
                @endif
                </dl>
            @endforeach
            </dd>
        @endif
    </dl>
    <div class="border border-dark border-rounded">
        <div id="mapid" style="height:400px;" name="map"></div>
    </div>
</div>



<script type="text/javascript">
    var center = [7.2906, 80.6337];

    // Create the map
    var map = L.map('mapid').setView(center, 10);

    // Set up the OSM layer 
    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Data © <a href="http://osm.org/copyright">OpenStreetMap</a>',
            maxZoom: 18
        }).addTo(map);


    //FROM LARAVEL THE COORDINATES ARE BEING TAKEN TO THE SCRIPT AND CONVERTED TO JSON
    var polygon = @json($polygon);
    console.log(polygon);

    //ADDING THE JSOON COORDINATES TO MAP
    var layer = L.geoJSON(JSON.parse(polygon)).addTo(map);

    // Adjust map to show the kml
    var bounds = layer.getBounds();
    map.fitBounds(bounds);
</script>
@endsection