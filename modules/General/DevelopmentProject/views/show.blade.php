@extends('home')

@section('cont')

<kbd><a href="/approval-item/showRequests" class="text-white font-weight-bolder"><i class="fas fa-chevron-left"></i></i> BACK</a></kbd>
<hr>
<div class="container">
    <dl class="row">
        <dt class="col-sm-3">Title:</dt>
        <dd class="col-sm-9">{{$development_project->title}}</dd>

        <dt class="col-sm-3">Category:</dt>
        <dd class="col-sm-9">Development Project</dd>

        <dt class="col-sm-3">Province:</dt>
        <dd class="col-sm-9">{{$land->district->province->province}}</dd>

        <dt class="col-sm-3">District:</dt>
        <dd class="col-sm-9">{{$land->district->district}}</dd>

        <dt class="col-sm-3">Grama Sevaka Division:</dt>
        <dd class="col-sm-9">{{$land->gs_division->gs_division}}</dd>

        @if($development_project->gazette_id)
        <dt class="col-sm-3">Gazette:</dt>
        <dd class="col-sm-9">{{$development_project->gazette->gazette_number}}</dd>
        @endif

        <dt class="col-sm-3">Description:</dt>
        <dd class="col-sm-9">
            <p>{{$development_project->description}}</p>
        </dd>

        <dt class="col-sm-3">Activity Organization:</dt>
        <dd class="col-sm-9">
            <p>{{$development_project->organization->title}}</p>
        </dd>

        <dt class="col-sm-3">Plan Number:</dt>
        <dd class="col-sm-9">{{$development_project->land_parcel->title}}</dd>

        <dt class="col-sm-3">Surveyor Name:</dt>
        <dd class="col-sm-9">{{$development_project->land_parcel->surveyor_name}}</dd>

        @if($development_project->land_size != 0)
        <dt class="col-sm-3">Land Size:</dt>
        <dd class="col-sm-9">{{$development_project->land_size}} acres</dd>
        @endif

        <dt class="col-sm-3">Status:</dt>
        <dd class="col-sm-9">{{$development_project->status->type}}</dd>

        <dt class="col-sm-3">Created at:</dt>
        <dd class="col-sm-9">{{$development_project->created_at}}</dd>

        <dt class="col-sm-3">User handling Your Request:</dt>
        @if($process->activity_user_id == NULL)
        <dd class="col-sm-9">No User Assigned Yet</dd>
        @else
        <dd class="col-sm-9">{{$process->activity_user->name}}</dd>
        @endif
    </dl>
    <div class="border border-dark border-rounded mt-4">
        <div id="mapid" style="height:400px;" name="map"></div>
    </div>

    <div class="row ml-1 mt-4">
        <div><strong>Photos:</strong></div>
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
    @if($process->status_id < 2) <div class="mt-3" style="float:right;">
        <!-- <a class="btn btn-outline-warning" href="/dev-project/edit/{{$process->id}}/{{$development_project->id}}/{{$land->id}}">Edit</a> -->
        <button class="btn btn-outline-danger" onclick="if (confirm('Are you sure you wish to delete this request and all it\'s related data?')){
            event.preventDefault();
            document.getElementById('form-delete-{{$process->id}}').submit()}">Delete</button>

        <form id="{{'form-delete-'.$process->id}}" style="display:none" method="post" action="/dev-project/delete/{{$process->id}}/{{$development_project->id}}/{{$land->id}}">
            @csrf
            @method('delete');
        </form>
</div>
@endif
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