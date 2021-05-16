@extends('general')

@section('general')
<div class="container">

    <!-- FAQ button -->
    <div class="d-flex mb-2 justify-content-end">
        <span class="mr-3" style="font-size:20px;"><strong>* means required field </strong></span>
        <span><kbd><a title="FAQ" class="text-white" data-toggle="modal" data-target="#devHelp">HELP</a></kbd></span>
    </div>
    @include('faq')
    <form action="/dev-project/saveForm" method="post" id="devForm" enctype="multipart/form-data">
        @csrf

        <div class="container">
            <div class="row p-4 bg-white">
                <div class="col border border-muted rounded-lg mr-2 p-4">
                    <div class="form-group">
                        <label for="title">Title*</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Required" id="title" name="title" value="{{ old('title') }}">
                        @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        District*<input type="text" class="form-control typeahead2 @error('district') is-invalid @enderror" value="{{ old('district') }}" placeholder="Required Search" name="district" />
                        @error('district')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        GS Division*<input type="text" class="form-control typeahead4 @error('gs_division') is-invalid @enderror" value="{{ old('gs_division') }}" placeholder="Required Search" name="gs_division" />
                        @error('gs_division')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        Gazette for Development Project (Optional)
                        <input type="text" class="form-control typeahead" placeholder="Search for Gazette Number" name="gazette" value="{{ old('gazette') }}" />
                        @error('gazette')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    @if(Auth::user()->role_id !=6) 
                    <div class="form-group">
                        <label for="organization">Activity Organization (Optional)</label>
                        <select class="custom-select @error('organization') is-invalid @enderror" name="organization">
                            <option  selected value="">Select Organization</option>
                            @foreach ($organizations as $organization)
                            <option value="{{ $organization->id }}" {{ Request::old()?(Request::old('organization')==$organization->id?'selected="selected"':''):'' }}>{{ $organization->title }}</option>
                            @endforeach
                        </select>
                        @error('organization')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="description">Description*</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" rows="2" id="description" placeholder="Required" name="description">{{{ old('description') }}}</textarea>
                        @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col border border-muted rounded-lg mr-2 p-4">
                    <div class="form-group" id="dynamicAddRemove">
                        <label for="images">Photos:</label>
                        <input type="file" id="image" name="file[]" multiple>
                        @if ($errors->has('file.*'))
                        <div class="alert">
                            <strong>{{ $errors->first('file.*') }}</strong>
                        </div>
                        @endif
                    </div>
                    @if(Auth()->user()->role_id != 6)
                    <br>
                    <hr><br>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck2" value="1" name="checkExternalRequestor" {{ old('checkExternalRequestor') == "1" ? 'checked' : ''}}>
                            <label class="custom-control-label" for="customCheck2"><strong>Creating on behalf of non-registered user</strong></label>
                        </div>
                    </div>
                    <div class="extRequestor" id="extRequestor">
                        <div class="form-group">
                            External Requestor<input type="text" class="form-control @error('externalRequestor') is-invalid @enderror" value="{{ old('externalRequestor') }}" name="externalRequestor" placeholder="Enter NIC" />
                            @error('externalRequestor')
                            <div class="alert alert-danger">The NIC format is Invalid</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            External Requestor Email<input type="text" class="form-control @error('erEmail') is-invalid @enderror" value="{{ old('erEmail') }}" placeholder="Enter email" name="erEmail" />
                            @error('erEmail')
                            <div class="alert alert-danger">Please Enter a Valid Email</div>
                            @enderror
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="row p-4 bg-white">
                <div class="col border border-muted rounded-lg p-4">
                    <!-- MAP CONTENT -->
                    <h4>Land Parcel Details</h4>
                    <div class="col-lg-8">
                        <div class="form-group">
                            <label for="title">Plan Number*</label>
                            <input type="text" class="form-control @error('planNo') is-invalid @enderror" value="{{ old('planNo') }}" placeholder="Required" id="planNo" name="planNo">
                            @error('planNo')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="title">Surveyor Name*</label>
                            <input type="text" class="form-control @error('surveyorName') is-invalid @enderror" value="{{ old('surveyorName') }}" placeholder="Required" id="surveyorName" name="surveyorName">
                            @error('surveyorName')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="land_extent">Land Extent (In Acres)</label>
                            <input type="text" class="form-control" value="{{ old('land_extent') }}" id="land_extent" name="land_extent">
                            @error('land_extent')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div id="accordion" class="mb-3">
                            <div class="card mb-3">
                                <div class="card-header bg-white">
                                    <a class="collapsed card-link text-dark" data-toggle="collapse" href="#collapseone">
                                        Organizations Governing Land (Optional)
                                    </a>
                                </div>
                                <div id="collapseone" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <strong>Select 1 or More</strong>
                                        <fieldset>
                                            @foreach($organizations as $organization)
                                            <input type="checkbox" name="land_governing_orgs[]" value="{{$organization->id}}" @if( is_array(old('land_governing_orgs')) && in_array($organization->id, old('land_governing_orgs'))) checked @endif><label class="ml-2">{{$organization->title}}</label> <br>
                                            @endforeach
                                        </fieldset>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header bg-white">
                                    <a class="collapsed card-link text-dark" data-toggle="collapse" href="#collapsetwo">
                                        Gazettes Relavant to Land (Optional)
                                    </a>
                                </div>
                                <div id="collapsetwo" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <strong>Select 1 or More</strong>
                                        <fieldset>
                                            @foreach($gazettes as $gazette)
                                            <input type="checkbox" name="land_gazettes[]" value="{{$gazette->id}}" @if( is_array(old('land_gazettes')) && in_array($gazette->id, old('land_gazettes'))) checked @endif> <label class="ml-2">{{$gazette->gazette_number}}</label> <br>
                                            @endforeach
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label>If coordinates are available as KML, upload KML File</label>
                        <input type="file" name="select_file" id="select_file" />
                        <input type="button" name="upload" id="upload" class="btn btn-primary" value="Upload">
                    </div>
                    <div class="alert mt-3" id="message" style="display: none"></div>
                    <br>
                    <label>Select Location On Map*</label>
                    <span style="float:right;"><kbd><a title="FAQ" class="text-white" data-toggle="modal" data-target="#mapHelp">How To Mark Location</a></kbd></span>
                    <!-- ////////MAP GOES HERE -->
                    <div id="mapid" style="height:400px;" name="map"></div>
                    @error('polygon')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <br>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck" value="1" name="isProtected" {{ old('isProtected') == "1" ? 'checked' : ''}}>
                        <label class="custom-control-label" for="customCheck"><strong>Click if land is a protected area.</strong></label>
                    </div>

                    <!-- saving the coordinates of the kml file -->
                    <input id="polygon" type="hidden" name="polygon" class="form-control @error('polygon') is-invalid @enderror" value="{{request('polygon')}}" />

                    <!-- Saving the KML file in storage -->
                    <input id="kml" type="hidden" name="kml" class="form-control" value="{{request('kml')}}" />

                    <div style="float:right;">
                        <button type="submit" class="btn bd-navbar text-light">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" class="form-control" name="createdBy" value="{{Auth::user()->id}}">
    </form>
</div>


<script type="text/javascript">
    ///TYPEAHEAD
    var path = "{{route('gazette')}}";
    $('input.typeahead').typeahead({
        source: function(terms, process) {

            return $.get(path, {
                terms: terms
            }, function(data) {
                console.log(data);
                objects = [];
                data.map(i => {
                    objects.push(i.gazette_number)
                })
                console.log(objects);
                return process(objects);
            })
        },
    });

    //THIS USES THE AUTOMECOMPLETE FUNCTION IN TREE REMOVAL CONTROLLER

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

    var path4 = "{{route('gramasevaka')}}";
    $('input.typeahead4').typeahead({
        source: function(terms, process) {

            return $.get(path4, {
                terms: terms
            }, function(data) {
                console.log(data);
                objects = [];
                data.map(i => {
                    objects.push(i.gs_division)
                })
                console.log(objects);
                return process(objects);
            })
        },
    });




    ///MAP ACTIVITIES

    //var center = [7.2906, 80.6337];

    // Create the map
    //var map = L.map('mapid').setView(center, 10);    
    //The first parameter passed into setView() represents the latitude and longitude, and the second parameter is the zoom level.


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

        //keeping the dynamic components open if checked
        if ($("#customCheck2").is(':checked')) {
            $("#extRequestor").show();
        } else {
            $("#extRequestor").hide()
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

    ///UPLOADING A FILE AND RETRIEVING AND CREATING A LAYER FROM IT.
    document.getElementById("upload").addEventListener("click", function() {
        var data = new FormData(document.getElementById("devForm"));
        event.preventDefault();
        $.ajax({
            url: "{{ route('ajaxmap.action') }}",
            method: "POST",
            data: data,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('#message').css('display', 'block');
                $('#message').html(data.message);
                $('#message').addClass(data.class_name);
                console.log(JSON.stringify(data.message));

                var tmp = data.uploaded_image;
                $('#loc').val(JSON.stringify(tmp)); //location of the uploaded file
                console.log(tmp);
                fetch(`/${tmp}`)
                    .then(res => res.text())
                    .then(kmltext => {
                        // Create new kml overlay
                        const track = new omnivore.kml.parse(kmltext);
                        map.addLayer(track);

                        //SAVING THE UPLOADED COORDIATE LAYER TO GEOJSON
                        $('#polygon').val(JSON.stringify(track.toGeoJSON()));

                        // Adjust map to show the kml
                        const bounds = track.getBounds();
                        map.fitBounds(bounds);
                    }).catch((e) => {
                        console.log(e);
                    })
            }
        })

    });


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

    //toggle extra details for external requestor
    $(function() {
        $("#customCheck2").click(function() {
            if ($(this).is(":checked")) {
                $("#extRequestor").show();
            } else {
                $("#extRequestor").hide();
            }
        });
    });
</script>
@endsection