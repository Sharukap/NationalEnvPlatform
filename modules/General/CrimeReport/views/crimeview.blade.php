@extends('home')

@section('cont')

<kbd><a href="/approval-item/showRequests" class="text-white font-weight-bolder"><i class="fas fa-chevron-left"></i></i> BACK</a></kbd>

<div class="container">
    <dl class="row">

        <dt class="col-sm-3">Category:</dt>
        <dd class="col-sm-9">Development Project</dd>

        <dt class="col-sm-3">Crime Type:</dt>
        <dd class="col-sm-9">{{$crime->Crime_type->type}}</dd>



        <dt class="col-sm-3">Land Parcel Title:</dt>
        <dd class="col-sm-9">
            <p>{{$crime->land_parcel->title}}</p>
        </dd>

        <dt class="col-sm-3">Activity Organization:</dt>
        <dd class="col-sm-9">
            <p>{{$process_item->Activity_organization->title}}</p>
        </dd>

        <dt class="col-sm-3">Status:</dt>
        <dd class="col-sm-9">{{$process_item->status->type}}</dd>

        <dt class="col-sm-3">Created at:</dt>
        <dd class="col-sm-9">{{$crime->created_at}}</dd>
    </dl>
    <div id="mapid" style="height:400px;" name="map"></div>
            <div class="row">
            @isset($Photos)
            <div class="row p-4">
                <div class="card-deck">
                    @foreach($Photos as $photo)
                    <div class="card" style="background-color:#99A3A4">
                        <img class="card-img-top" src="{{asset('/storage/'.$photo)}}" alt="photo">
                        <div class="card-body text-center">
                        <a class="nav-link text-dark font-italic p-2" href="/item-report/downloadimage/{{$photo}}">Download Image</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        @endisset
        @empty($Photos)
            <p>No photos included in the application</p>
        @endempty
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
    L.geoJSON(JSON.parse(polygon)).addTo(map);
    
    
</script>
@endsection