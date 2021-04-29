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
            <h3>Report of Restoration Request ID {{$restoration->id}}</h3>
        </div>
    </div>
    <div class="row p-4 bg-white">
        <div class="col border border-muted rounded-lg mr-2 p-4">
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
        </div>
    </div>
    <div class="row p-4 bg-white">
        <div class="col border border-muted rounded-lg mr-2 p-2">
            <dt class="col-sm-5">Restored Species</dt>
            <hr>
            @if($species==null)
            <dd class="col-sm-12">No restored species specified in the request made</dd>
            @else
            <dd class="col-sm-7">

                @foreach($species as $individualSpecies)
                <h6>Restored Species {{$count}}</h6>
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
            <br /> <br />
            <br />
            <div style="display: none;">{{$count++}};</div>
            @endforeach
            </dd>
            @endif
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