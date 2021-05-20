@extends('home')

@section('cont')
<kbd><a href="/environment/updatedataspecies" class="text-white font-weight-bolder"><i class="fas fa-chevron-left"></i></i> BACK</a></kbd>

<div class="container">
    <h4 style="text-align:center;" class="text-dark">Add New Species</h4>
    <div class="row justify-content-md-center border p-4 bg-white">
        <div class="col-lg ml-3">
            <!-- FAQ button -->
            <div class="d-flex mb-2 justify-content-end">
                <span class="mr-3" style="font-size:20px;"><strong>* means required field </strong></span>
                <span><kbd><a title="FAQ" class="text-white" data-toggle="modal" data-target="#speciesHelp">HELP</a></kbd></span>
            </div>
            @include('faq')


            <form action='/environment/newspecies' method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf

                @if(\Session::has('success'))
                <div class="alert alert-success">
                    <p>{{\Session::get('success') }} </p>

                </div>
                @endif

                <div class="row p-2 bg-white">
                    <div class="col border border-muted rounded-lg mr-2 p-4">
                        <div class="row p-2 mt-2">
                            <div class="col">
                                <div class="form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Species Type<strong>*</strong></span>

                                        <select name="type" input type="text" class="form-control @error('type') is-invalid @enderror" id="type" placeholder="Required" required>
                                            <option disabled selected value="">Select the species type</option>
                                            <option value="fauna">Fauna</option>
                                            <option value="flora">Flora</option>
                                        </select>
                                    </div>
                                    @error('type')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <label>Species Title<strong>*</strong></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" id="title" name="title" placeholder="Required" required>
                                    @error('title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                </br>
                                <label>Scientific Name</label>
                                <div class="form-group">
                                    <input type="text" name="scientific_name" class="form-control @error('scientific_name') is-invalid @enderror" value="{{ old('scientific_name') }}" placeholder="Enter name">
                                </div>
                            </div>
                        </div>

                        <div class="row p-2 mt-2">
                            <div class="col">
                                <h6>Other Taxanomic Heirachy Details</h6>
                                <div class="row p-2 mt-2">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Kingdom</label>
                                            <input type="text" name="kingdom" class="form-control @error('kingdom') is-invalid @enderror" value="{{ old('kingdom') }}" placeholder="Enter name">
                                            @error('kingdom')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Class</label>
                                            <input type="text" name="class" class="form-control @error('class') is-invalid @enderror" value="{{ old('class') }}" placeholder="Enter name">
                                            @error('class')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Family</label>
                                            <input type="text" name="family" class="form-control @error('family') is-invalid @enderror" value="{{ old('family') }}" placeholder="Enter name">
                                            @error('family')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Phylum</label>
                                            <input type="text" name="phylum" class="form-control @error('phylum') is-invalid @enderror" value="{{ old('phylum') }}" placeholder="Enter name">
                                            @error('phylum')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Order</label>
                                            <input type="text" name="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order') }}" placeholder="Enter name">
                                            @error('order')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Genus</label>
                                            <input type="text" name="genus" class="form-control @error('genus') is-invalid @enderror" value="{{ old('genus') }}" placeholder="Enter name">
                                            @error('genus')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row p-2 mt-2">
                            <div class="col">
                                <div id="accordion" class="mb-3">
                                    <div class="card">
                                        <div class="card-header bg-white">
                                            <a class="collapsed card-link text-dark" data-toggle="collapse" href="#collapsetwo">
                                                Habitats<strong>*</strong>
                                            </a>
                                        </div>
                                        <div id="collapsetwo" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                                <strong>Select Multiple</strong>
                                                <fieldset required>
                                                    <input type="checkbox" name="habitat[]" value="Montane forest"><label class="ml-2">Montane forest</label> <br>
                                                    <input type="checkbox" name="habitat[]" value="Sub-Montane forest"><label class="ml-2">Sub-Montane forest</label> <br>
                                                    <input type="checkbox" name="habitat[]" value="Low land wet evergreen forest"><label class="ml-2">Low land wet evergreen forest</label> <br>
                                                    <input type="checkbox" name="habitat[]" value="Dry mixed evergreen forest"><label class="ml-2">Dry mixed evergreen forest</label> <br>
                                                </fieldset>
                                            </div>
                                        </div>
                                        @error('habitat')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row p-2 mt-2">
                            <div class="col">
                                <label>Species Description<strong>*</strong></label>
                                <textarea class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}" rows="5" name="description" placeholder="required" required>{{ old('description') }}</textarea>

                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        </br>

                        </br>
                        <div class="row p-2 mt-2">
                            <div class="col">
                                <h5><strong>Regions where species is commonly found </strong></h5>
                                <div class="col border border-muted rounded-lg p-4">
                                    <!-- ////////MAP GOES HERE -->
                                    <div id="mapid" style="height:400px;" name="map"></div>

                                    @error('polygon')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <input id="polygon" type="hidden" name="polygon" class="form-control @error('polygon') is-invalid @enderror" value="{{request('polygon')}}" /> <br>

                                </div>
                            </div>
                        </div>
                        <div class="row p-2 mt-2">
                            <div class="col">
                                <div class="form-group">
                                    <label for="images">Image</label>
                                    <div class="custom-file mb-3">
                                        <input type="file" id="images" name="images">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-3" style="float:right;">
                            <button type="submit" name="submit" class="btn bd-navbar text-white">Submit</button>
                        </div>

                        <input type="hidden" class="form-control" name="createby" value="{{Auth::user()->id}}">
                        <input type="hidden" class="form-control" name="status" value="0">
                    </div>
                </div>
                </from>
        </div>
    </div>
</div>


<script type="text/javascript">
    ///SCRIPT FOR THE MAP
    var center = [7.2906, 80.6337];

    // Create the map
    var map = L.map('mapid').setView(center, 10);

    // Set up the OSM layer 
    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Data © <a href="http://osm.org/copyright">OpenStreetMap</a>',
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