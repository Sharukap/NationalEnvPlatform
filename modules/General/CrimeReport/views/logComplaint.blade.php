@extends('general')

@section('general')
<div class="container">
    <!-- FAQ button -->
    <div class="d-flex mb-2 justify-content-end">
        <span class="mr-3" style="font-size:20px;"><strong>* means required field </strong></span>
        <span><kbd><a title="FAQ" class="text-white" data-toggle="modal" data-target="#complaintsHelp">HELP</a></kbd></span>
    </div>
    @include('faq')
    <form action="\crime-report\crimecreate" method="post" enctype="multipart/form-data">
        @csrf
        <div class="container bg-white">
            <div class="row p-4 bg-white">
                <div class="col border border-muted rounded-lg mr-2 p-4">
                    <div class="form-group">
                        <label for="crime_type">Complaint Type*</label>
                        <select name="crime_type" class="custom-select">
                            <option disabled selected value="">Select Complaint Type</option>
                            @foreach($crime_types as $crime_type)
                            @if (old('crime_type') == $crime_type->id)
                            <option value="{{ $crime_type->id }}">{{$crime_type->type}}</option>
                            @else
                            <option value="{{$crime_type->id}}">{{$crime_type->type}}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('crime_type')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    @if(Auth::user()->role_id !=6) 
                    <div class="form-group">
                        <label for="organization">Make complaint to (Optional)</label>
                        <select class="custom-select @error('organization') is-invalid @enderror" name="organization">
                            <option selected value="">Select Organization</option>
                            @foreach ($Organizations as $organization)
                            <option value="{{ $organization->id }}" {{ Request::old()?(Request::old('organization')==$organization->id?'selected="selected"':''):'' }}>{{ $organization->title }}</option>
                            @endforeach
                        </select>
                        @error('organization')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    @endif
                    <div class="form-group" id="dynamicAddRemove">
                        <label for="images">Photos:</label>
                        <input type="file" id="image" name="file[]" multiple>
                        @if ($errors->has('file.*'))
                        <div class="alert alert-danger">{{ $errors->first('file.*') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" rows="3" placeholder="Required" name="description">{{ old('description') }}</textarea>
                        @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <hr>
                    <div class="form-group">
                        <input type="checkbox" name="nonreguser" value="1"><strong> Creating on behalf of non registered user</strong>
                        <br>
                        <label for="description">Requestor NIC:</label>
                        <input type="text" class="form-control" placeholder="Enter NIC" name="Requestor" value="{{ old('Requestor') }}" />
                        @error('Requestor')
                        <div class="alert alert-danger">The NIC Format is Invalid</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Requestor email:</label>
                        <input type="text" class="form-control" placeholder="Enter complainant's email" name="Requestor_email" value="{{ old('Requestor_email') }}" />
                        @error('Requestor_email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-check">
                        <input type="hidden" class="form-control" name="create_by" value="{{ Auth::user()->id }}">
                        <input id="polygon" type="hidden" name="polygon" value="{{request('polygon')}}">
                    </div>
                </div>
                <div class="col border border-muted rounded-lg p-4">
                    <div class="form-group">
                        <label for="landTitle">Area name*</label>
                        <input type="text" class="form-control" placeholder="Required" id="landTitle" name="landTitle" value="{{ old('landTitle') }}">
                        @error('landTitle')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="district">District*</label>
                        <select class="custom-select @error('district') is-invalid @enderror" name="district">
                            <option disabled selected value="">Select</option>
                            @foreach ($districts as $district)
                            <option value="{{ $district->id }}" {{ Request::old()?(Request::old('district')==$district->id?'selected="selected"':''):'' }}>{{ $district->district }}</option>
                            @endforeach
                        </select>
                        @error('district')
                        <div class="alert alert-danger">{{ $message }}</div>
                            
                        @enderror
                    </div>
                    <!-- ////////MAP GOES HERE -->
                    <div id="mapid" style="height:400px;" name="map"></div>
                    @error('polygon')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <br>
                    <div><label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="confirm"><strong>I confirm these information to be true</strong>
                            @error('confirm')
                            <div class="alert alert-danger">You must confirm that the details provided are true.</div>
                            @enderror
                        </label>
                    </div>

                    <div style="float:right;"><button type="submit" class="btn btn-primary">Submit</button></div>
                </div>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    var map = L.map('mapid', {
        center: [7.2906, 80.6337], //if the location cannot be fetched it will be set to Kandy
        zoom: 12
    });

    window.onload = function() {
        var popup = L.popup();
        //false,               ,popup, map.center
        function geolocationErrorOccurred(geolocationSupported, popup, latLng) {
            popup.setLatLng(latLng);
            popup.setContent(geolocationSupported ?
                '<b>Error:</b> Geolocation service failed. Enable Location.' :
                '<b>Error:</b> This browser doesn\'t support geolocation.');
            popup.openOn(map);
        }
        //If theres an error then 

        if (navigator.geolocation) { //using an inbuilt function to get the lat and long of the user.
            navigator.geolocation.getCurrentPosition(function(position) {
                var latLng = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                popup.setLatLng(latLng);
                popup.setContent('This is your current location');
                popup.openOn(map);
                //setting the map to the user location
                map.setView(latLng);

            }, function() {
                geolocationErrorOccurred(true, popup, map.getCenter());
            });
        } else {
            //No browser support geolocation service
            geolocationErrorOccurred(false, popup, map.getCenter());
        }
    }

    // Set up the OSM layer 
    //map tiles are “square bitmap graphics displayed in a grid arrangement to show a map.”
    //There are a number of different tile providers (or tileservers), some are free and open source. We are using OSM
    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Data © <a href="http://osm.org/copyright">OpenStreetMap</a>',
            maxZoom: 18
        }).addTo(map);
    //we’re calling tilelayer() to create the tile layer, passing in the OSM URL first, then the second argument is an object containing the options for our new tile 
    //layer (including attribution is critical here to comply with licensing), and then the tile layer is added to the map using addTo().

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


        drawnItems.addLayer(layer);
        $('#polygon').val(JSON.stringify(drawnItems.toGeoJSON())); //geoJSON converts a layer to JSON

        ///Converting your layer to a KML
        $('#kml').val(tokml(drawnItems.toGeoJSON()));
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

    //adding images
    $(document).ready(function() {
        $('#image').change(function() {
            var fp = $("#image");
            var lg = fp[0].files.length; // get length
            var items = fp[0].files;
            var fileSize = 0;

            if (lg > 0) {
                for (var i = 0; i < lg; i++) {
                    fileSize = fileSize + items[i].size; // get file size
                }
                if (fileSize > 5242880) {
                    alert('You should not uplaod files exceeding 4 MB. Please compress files size and uplaod agian');
                    $('#image').val('');
                }
            }
        });
    });
</script>
@endsection