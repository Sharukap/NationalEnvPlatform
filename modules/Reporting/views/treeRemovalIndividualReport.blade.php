<!DOCTYPE html>
<html lang="en">

<head>
    <title>National Environment Platform</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        .img {
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="row p-4 bg-white">
        <div class="col border border-muted rounded-lg mr-2 p-4">
            <h1> National Environment Platform</h1>
            <h3>Report of Tree Removal Request ID {{$tree->id}}</h3>
        </div>
    </div>
    <div class="row p-4 bg-white">
        <div class="col border border-muted rounded-lg mr-2 p-4">
            <dt class="col-sm-5">Province:</dt>
            <dd class="col-sm-7">{{$tree->district->province->province}}</dd>
            <dt class="col-sm-5">District:</dt>
            <dd class="col-sm-7">{{$tree->district->district}}</dd>

            <dt class="col-sm-5">Grama Sevaka Division:</dt>
            <dd class="col-sm-7">{{$tree->gs_division->gs_division}}</dd>

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

            <dt class="col-sm-5">Land Parcel:</dt>
            <dd class="col-sm-7">{{$tree->land_parcel->title}}</dd>

            <dt class="col-sm-5">Status:</dt>
            <dd class="col-sm-7">{{$tree->status->type}}</dd>

            <dt class="col-sm-5">Created at:</dt>
            <dd class="col-sm-7">{{$tree->created_at}}</dd>
        </div>
    </div>
    <div class="row p-4 bg-white">
        <div class="col border border-muted rounded-lg mr-2 p-2">
            <dt class="col-sm-5">Properties</dt>
            <hr>
            @if($location==0)
            <dd class="col-sm-7">No Properties</dd>
            @else
            @for($x = 0; $x < count($location); $x++) <dd class="col-sm-7">
                <dt class="col-sm-7">Tree Species ID:</dt>
                <dd class="col-sm-5">{{$location[$x]['tree_species_id']}}</dd>

                <dt class="col-sm-7">Tree ID:</dt>
                <dd class="col-sm-5">{{$location[$x]['tree_id']}}</dd>

                <dt class="col-sm-7">Width at Breast Height:</dt>
                <dd class="col-sm-5">{{$location[$x]['width_at_breast_height']}}</dd>

                <dt class="col-sm-7">Height:</dt>
                <dd class="col-sm-5">{{$location[$x]['height']}}</dd>

                <dt class="col-sm-7">Timber Volume:</dt>
                <dd class="col-sm-5">{{$location[$x]['timber_volume']}}</dd>

                <dt class="col-sm-7">Cubic Feet:</dt>
                <dd class="col-sm-5">{{$location[$x]['timber_cubic']}}</dd>

                <dt class="col-sm-7">Age</dt>
                <dd class="col-sm-5">{{$location[$x]['age']}}</dd>

                <dt class="col-7">Remarks</dt>
                <dd class="col-5">{{$location[$x]['remark']}}</dd>
                </dd>
                @endfor
                @endif
        </div>
    </div>
    <div class="row p-4 bg-white">
        <div class="col border border-muted rounded-lg mr-2 p-4">
            <div><strong>Photos:</strong></div>
            @isset($Photos)
            <div class="row p-4">
                <div class="card-deck">
                    @foreach($Photos as $photo)
                    <div class="card" style="background-color:#99A3A4">
                        <img class="card-img-top" src="{{$photo}}" alt="photo">
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
    <div class="row p-4 bg-white">
        <div class="col border border-muted rounded-lg mr-2 p-4">
            <div class="d-flex bg-light justify-content-center">
                <h5 class="text-secondary"> &copy; 2021 by RFSL - LSF - Ministry of Environment</h5><br>
            </div>
        </div>
    </div>
</body>

</html>