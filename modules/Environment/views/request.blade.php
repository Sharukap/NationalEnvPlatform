@extends('home')

@section('cont')
<kbd><a href="/environment/updatedata" class="text-white font-weight-bolder"><i class="fas fa-chevron-left"></i></i> BACK</a></kbd>

<div class="container">
    <h4 style="text-align:center;" class="text-dark">Add New Ecosystem</h4>
    <div class="row justify-content-md-center border p-4 bg-white">
        <div class="col-lg ml-3">
            <!-- FAQ button -->
            <div class="d-flex mb-2 justify-content-end">
                <span class="mr-3" style="font-size:20px;"><strong>* means required field </strong></span>
                <span><kbd><a title="FAQ" class="text-white" data-toggle="modal" data-target="#ecoHelp">HELP</a></kbd></span>
            </div>
            @include('faq')

            <form action="/environment/newrequest" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
                @if(\Session::has('success'))
                <div class="alert alert-success">
                    <p>{{\Session::get('success') }} </p>
                </div>
                @endif
                <div class="row p-2 bg-white">
                    <div class="col border border-muted rounded-lg mr-2 p-4">
                        <div class="form-group">
                            <label for="title">Title:*</label>
                            <input type="text" class="form-control" placeholder="Enter Title" id="title" name="title" value="{{ old('title') }}" required/>
                            @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Type*</span>
                            </div>
                            <select name="eco_type" class="custom-select @error('eco_type') is-invalid @enderror" required>
                                <option disabled selected value="">Select</option>
                                @foreach ($data as $page)
                                <option value="{{ $page->id }}">{{ $page->type }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('eco_type')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        </br>

                        <div class="form-group">
                            District:*<input type="text" class="form-control typeahead2 @error('district') is-invalid @enderror" value="{{ old('district') }}" placeholder="Search" name="district" required/>
                            @error('district')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <label for="description">Description:</label>
                        <textarea class="form-control" rows="5" name="description"></textarea>
                        



                        </br>
                        <div class="col border border-muted rounded-lg p-4">
                            <!-- ////////MAP GOES HERE -->
                            <div id="mapid" style="height:400px;" name="map"></div>
                            @error('polygon')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck" value="1" name="isProtected">
                                <label class="custom-control-label" for="customCheck"><strong>Is Protected Area?</strong></label>
                            </div>
                            <input id="polygon" type="hidden" name="polygon" class="form-control @error('polygon') is-invalid @enderror" value="{{request('polygon')}}" /> <br>
                        </div>


                        <div class="form-group">
                            <label for="images">Image</label>
                            <div class="custom-file mb-3">
                                <input type="file" id="images" name="images">
                            </div>
                        </div>

                        <div style="float:right;">
                            <button type="submit" name="submit" class="btn bd-navbar text-white">Submit</button>
                        </div>


                        <input type="hidden" class="form-control" name="createby" value="{{Auth::user()->id}}">
                        <input type="hidden" class="form-control" name="status" value="0">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">
    // Typeahed to get the data from the district table_autocomplete
    var path2 = "{{route('district')}}";
    $('input.typeahead2').typeahead({
        source: function(terms, process) {

            return $.get(path2, {
                terms: terms
            }, function(data) {
                console.log(data);
                objects = [];
                data.map(i => {
                    objects.push(i.district)
                })
                console.log(objects);
                return process(objects);
            })
        },
    });

    ///SCRIPT FOR THE MAP
    var center = [7.2906, 80.6337];

    // Create the map
    var map = L.map('mapid').setView(center, 10);

    // Set up the OSM layer 
    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Data ?? <a href="http://osm.org/copyright">OpenStreetMap</a>',
            maxZoom: 18
        }).addTo(map);

    var drawnItems = new L.FeatureGroup();
    map.addLayer(drawnItems);

    var drawControl = new L.Control.Draw({
        position: 'topright',
        draw: {
            polygon: {
                shapeOptions: {
                    color: 'purple'
                },
                allowIntersection: false,
                drawError: {
                    color: 'orange',
                    timeout: 1000
                },
                showArea: true,
                metric: false,
                repeatMode: true
            },
            polyline: {
                shapeOptions: {
                    color: 'red'
                },
            },
            circlemarker: false,
            rect: {
                shapeOptions: {
                    color: 'green'
                },
            },
            circle: false,
        },
        edit: {
            featureGroup: drawnItems
        }
    });
    map.addControl(drawControl);

    map.on('draw:created', function(e) {
        var type = e.layerType,
            layer = e.layer;

        if (type === 'marker') {
            layer.bindPopup('A popup!');
        }

        drawnItems.addLayer(layer);
        $('#polygon').val(JSON.stringify(layer.toGeoJSON()));
    });

    //SEARCH FUNCTIONALITY
    var searchControl = new L.esri.Controls.Geosearch().addTo(map);

    var results = new L.LayerGroup().addTo(map);

    searchControl.on('results', function(data) {
        results.clearLayers();
        for (var i = data.results.length - 1; i >= 0; i--) {
            results.addLayer(L.marker(data.results[i].latlng));
        }
    });

    setTimeout(function() {
        $('.pointer').fadeOut('slow');
    }, 3400);
</script>
@endsection