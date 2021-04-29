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
            <h3>Report of Development Project Request ID {{$development_project->id}}</h3>
        </div>
    </div>
    <div class="row p-4 bg-white">
        <div class="col border border-muted rounded-lg mr-2 p-4">
            <dt class="col-sm-3">Title:</dt>
            <dd class="col-sm-9">{{$development_project->title}}</dd>

            <dt class="col-sm-3">Category:</dt>
            <dd class="col-sm-9">Development Project</dd>

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

            <dt class="col-sm-3">Land Parcel:</dt>
            <dd class="col-sm-9">{{$development_project->land_parcel->title}}</dd>

            @if($development_project->land_size != 0)
            <dt class="col-sm-3">Land Size:</dt>
            <dd class="col-sm-9">{{$development_project->land_size}} acres</dd>
            @endif

            <dt class="col-sm-3">Status:</dt>
            <dd class="col-sm-9">{{$development_project->status->type}}</dd>

            <dt class="col-sm-3">Created at:</dt>
            <dd class="col-sm-9">{{$development_project->created_at}}</dd>
        </div>
    </div>
    <!-- <div class="row p-4 bg-white">
        <div class="col border border-muted rounded-lg mr-2 p-4">

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
    </div> -->

    <div class="row p-4 bg-white">
        <div class="col border border-muted rounded-lg mr-2 p-4">
            <div class="d-flex bg-light justify-content-center">
                <h5 class="text-secondary"> &copy; 2021 by RFSL - LSF - Ministry of Environment</h5><br>
            </div>
        </div>
    </div>
</body>

</html>