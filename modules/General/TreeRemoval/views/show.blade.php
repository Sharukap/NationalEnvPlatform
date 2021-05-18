@extends('home')

@section('cont')

<kbd><a href="/approval-item/showRequests" class="text-white font-weight-bolder"><i class="fas fa-chevron-left"></i></i> BACK</a></kbd>
<hr>
<div class="container">
    <div class="row">
        <div class="col border border-muted rounded-lg mr-2 p-2">
            <dl class="row">
                <dt class="col-sm-5">Province:</dt>
                <dd class="col-sm-7">{{$tree->district->province->province}}</dd>

                <dt class="col-sm-5">District:</dt>
                <dd class="col-sm-7">{{$tree->district->district}}</dd>

                @if($tree->gs_division_id)
                <dt class="col-sm-5">Grama Sevaka Division:</dt>
                <dd class="col-sm-7">{{$tree->gs_division->gs_division}}</dd>
                @endif

                <dt class="col-sm-5">Description:</dt>
                <dd class="col-sm-7">
                    <p>{{$tree->description}}</p>
                </dd>

                <dt class="col-sm-5">Activity Organization:</dt>
                <dd class="col-sm-7">
                    <p>{{$tree->organization->title}}</p>
                </dd>

                <dt class="col-sm-5">Category:</dt>
                <dd class="col-sm-7">Tree Removal</dd>

                @if($tree->land_size != 0)
                <dt class="col-sm-5">Land Size:</dt>
                <dd class="col-sm-7">{{$tree->land_size}} acres</dd>
                @endif

                <dt class="col-sm-5">Plan Number:</dt>
                <dd class="col-sm-7">{{$tree->land_parcel->title}}</dd>

                <dt class="col-sm-5">Surveyor Name:</dt>
                <dd class="col-sm-7">{{$tree->land_parcel->surveyor_name}}</dd>

                <dt class="col-sm-5">Status:</dt>
                <dd class="col-sm-7">{{$tree->status->type}}</dd>

                <dt class="col-sm-5">Created at:</dt>
                <dd class="col-sm-7">{{$tree->created_at}}</dd>

                <dt class="col-sm-5">User handling Your Request:</dt>
                @if($process->activity_user_id == NULL)
                <dd class="col-sm-7">No User Assigned Yet</dd>
                @else
                <dd class="col-sm-7">{{$process->activity_user->name}}</dd>
                @endif
        </div>
        <div class="col border border-muted rounded-lg mr-2 p-2">
            <dl class="row">
                <dt class="col-sm-5">Number of Trees:</dt>
                <dd class="col-sm-7">{{$tree->no_of_trees}}</dd>

                <dt class="col-sm-5">Number of Tree Species:</dt>
                <dd class="col-sm-7">{{$tree->no_of_tree_species}}</dd>

                <dt class="col-sm-5">Number of Mammal Species:</dt>
                <dd class="col-sm-7">{{$tree->no_of_mammal_species}}</dd>

                <dt class="col-sm-5">Number of Amphibian Species:</dt>
                <dd class="col-sm-7">{{$tree->no_of_amphibian_species}}</dd>

                <dt class="col-sm-5">Number of Reptile Species:</dt>
                <dd class="col-sm-7">{{$tree->no_of_reptile_species}}</dd>

                <dt class="col-sm-5">Number of Avian Species:</dt>
                <dd class="col-sm-7">{{$tree->no_of_avian_species}}</dd>

                <dt class="col-sm-5">Number of Floral Species:</dt>
                <dd class="col-sm-7">{{$tree->no_of_flora_species}}</dd>

                <dt class="col-sm-5">Species Special Notes:</dt>
                <dd class="col-sm-7">
                    <p>{{$tree->species_special_notes}}</p>
                </dd>

                <dt class="col-sm-5">Special Approval:</dt>
                <dd class="col-sm-7">{{$tree->special_approval}}</dd>
            </dl>
        </div>
    </div>

    <div class="border border-muted rounded-lg mr-2 p-2 mt-4">
        <h4 class="mb-3">Properties</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tree Species:</th>
                    <th>Tree ID:</th>
                    <th>Circumference at Breast Height:</th>
                    <th>Height:</th>
                    <th>Approx. Timber Volume:</th>
                    <th>Age</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                @for($x = 0; $x < count($location); $x++) <dd class="col-sm-7">
                    <tr>
                        <td>{{$x+1}}</td>
                        <td>{{$location[$x]['tree_species_id']}}</td>
                        <td>{{$location[$x]['tree_id']}}</td>
                        <td>{{$location[$x]['circumference_at_breast_height']}} meter(s)</td>
                        <td>{{$location[$x]['height']}} meter(s)</td>
                        <td>{{$location[$x]['timber_volume']}} m<sup>3</sup></td>
                        <td>{{$location[$x]['age']}}</td>
                        <td>{{$location[$x]['remark']}}</td>
                    </tr>
                    @endfor
            </tbody>
        </table>
    </div>


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
                    <img class="card-img-top" src="{{$photo}}" alt="photo">
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
    @if($process->status_id < 2) <div style="float:right;">
        <button class="btn btn-danger text-white" onclick="if(confirm('Are you sure you wish to delete this request and all it\'s related data?')){ event.preventDefault();
                            document.getElementById('form-delete-{{$process->id}}').submit()}">Delete Request</button>

        <form id="{{'form-delete-'.$process->id}}" style="display:none" method="post" action="/tree-removal/delete/{{$process->id}}/{{$tree->id}}/{{$land->id}}">
            @csrf
            @method('delete');
        </form>
</div>
@endif
</div>

<script>
    /// MAP MODULE
    var center = [7.2906, 80.6337];

    // Create the map
    var map = L.map('mapid').setView(center, 10);

    // Set up the OSM layer 
    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Data © <a href="http://osm.org/copyright">OpenStreetMap</a>',
            maxZoom: 18
        }).addTo(map);


    var polygon = @json($polygon);
    var layer = L.geoJSON(JSON.parse(polygon)).addTo(map);

    // Adjust map to show the kml
    var bounds = layer.getBounds();
    map.fitBounds(bounds);
</script>
@endsection