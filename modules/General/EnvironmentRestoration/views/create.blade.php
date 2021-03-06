@extends('general')

@section('general')
<div class="container">
    <!-- FAQ button -->
    <div class="d-flex mb-2 justify-content-end">
        <span class="mr-3" style="font-size:20px;"><strong>* means required field </strong></span>
        <span><kbd><a title="FAQ" class="text-white" data-toggle="modal" data-target="#restorationHelp">HELP</a></kbd></span>
    </div>
    @include('faq')

    <form action="/env-restoration/store" id="envForm" method="post" autocomplete="off">
        @csrf
        <!-- One "tab" for each step in the form: -->
        <div class="tab">
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
                            <label for="title">Area Name*</label>
                            <input type="text" class="form-control @error('landparceltitle') is-invalid @enderror" placeholder="Enter Land Parcel Name" name="landparceltitle" value="{{ old('landparceltitle') }}">
                            @error('landparceltitle')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="title">District*</label>
                            <input type="text" class="form-control typeahead2 @error('district') is-invalid @enderror" value="{{ old('district') }}" placeholder="Search" name="district" />
                            @error('district')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="title">Environment Restoration Activity</label>
                            <select name="environment_restoration_activity" class="custom-select @error('environment_restoration_activity') is-invalid @enderror">
                                <option selected>Select Activity</option>
                                @foreach($restoration_activities as $restoration_activity)
                                <option value="{{$restoration_activity->id}}" {{ Request::old()?(Request::old('environment_restoration_activity')==$restoration_activity->id?'selected="selected"':''):'' }}>{{$restoration_activity->title}}</option>
                                @endforeach
                                @error('environment_restoration_activity')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="title">Ecosystem</label>
                            <select name="ecosystem" class="custom-select @error('ecosystem') is-invalid @enderror">
                                <option selected>Select Ecosystem</option>
                                @foreach($ecosystems as $ecosystem)
                                <option value="{{$ecosystem->id}}" {{ Request::old()?(Request::old('ecosystem')==$ecosystem->id?'selected="selected"':''):'' }}>{{$ecosystem->type}}</option>
                                @endforeach
                            </select>
                            @error('ecosystem')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        @if(Auth::user()->role_id !=6)
                        <div class="form-group">
                            <div class="card">
                                <div class="card-header">
                                    <a class="collapsed card-link text-dark" data-toggle="collapse" href="#collapseOne">Governing Organization for selected Land Parcel (Optional)</a>
                                </div>
                                <div id="collapseOne" class="collapse">
                                    <div class="card-body">
                                        @foreach($organizations as $organization)
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="govOrg[]" value="{{$organization->id}}">{{$organization->title}}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="request_org">Organization to submit request to (optional)</label>
                            <select name="activity_org" class="custom-select @error('activity_org') is-invalid @enderror">
                                <option selected value="0">Select Organization</option>
                                @foreach($organizations as $organization)
                                <option value="{{ $organization->id }}" {{ Request::old()?(Request::old('activity_org')==$organization->id?'selected="selected"':''):'' }}>{{ $organization->title }}</option>
                                @endforeach
                            </select>
                            @error('activity_org')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col border border-muted rounded-lg p-4">
                        <label>Select Location On Map*</label>
                        <span style="float:right;"><kbd><a title="FAQ" class="text-white" data-toggle="modal" data-target="#mapHelp">How To Mark Location</a></kbd></span>
                        <!-- ////////MAP GOES HERE -->
                        <div id="mapid" style="height:400px;" name="map"></div>

                        @error('polygon')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input id="polygon" type="hidden" name="polygon" class="form-control @error('polygon') is-invalid @enderror" value="{{request('polygon')}}" /> <br>
                        <div class="form-check">
                            <a href="https://www.globalforestwatch.org/dashboards/country/LKA/?category=summary&dashboardPrompts=eyJzaG93UHJvbXB0cyI6dHJ1ZSwicHJvbXB0c1ZpZXdlZCI6WyJ2aWV3TmF0aW9uYWxEYXNoYm9hcmRzIl0sInNldHRpbmdzIjp7Im9wZW4iOmZhbHNlLCJzdGVwSW5kZXgiOjAsInN0ZXBzS2V5IjoiIn0sIm9wZW4iOnRydWUsInN0ZXBzS2V5IjoiZG93bmxvYWREYXNoYm9hcmRTdGF0cyJ9&location=WyJjb3VudHJ5IiwiTEtBIl0%3D&map=eyJjZW50ZXIiOnsibGF0Ijo3Ljg4NjkzMTg0MzkyMjQzMywibG5nIjo4MC43NzgwNTcwOTk5NzM4OH0sInpvb20iOjYuNzMwNDAwNzIyNzExMTcsImNhbkJvdW5kIjpmYWxzZSwiZGF0YXNldHMiOlt7ImRhdGFzZXQiOiJwb2xpdGljYWwtYm91bmRhcmllcyIsImxheWVycyI6WyJkaXNwdXRlZC1wb2xpdGljYWwtYm91bmRhcmllcyIsInBvbGl0aWNhbC1ib3VuZGFyaWVzIl0sImJvdW5kYXJ5Ijp0cnVlLCJvcGFjaXR5IjoxLCJ2aXNpYmlsaXR5Ijp0cnVlfSx7ImRhdGFzZXQiOiJ0cmVlLWNvdmVyLWxvc3MiLCJsYXllcnMiOlsidHJlZS1jb3Zlci1sb3NzIl0sIm9wYWNpdHkiOjEsInZpc2liaWxpdHkiOnRydWUsInBhcmFtcyI6eyJ0aHJlc2hvbGQiOjMwLCJ2aXNpYmlsaXR5Ijp0cnVlfX1dfQ%3D%3D" target="_blank">See Affected regions in Sri Lanka</a>
                        </div>
                        <br />
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck" value="1" name="isProtected">
                            <label class="custom-control-label" for="customCheck"><strong>Click if Demarcated Land is a Protected Area</strong></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab">
            <div class="container">
                <div class="row border rounded-lg p-4 bg-white">
                    @error('speciesname')
                    <div class="alert alert-danger">The Restored Species Field Is Required</div>
                    @enderror
                    @error('quantity')
                    <div class="alert alert-danger">The Quantity field of the Relevant Restored Species Is Required and it must be a number</div>
                    @enderror

                    <!-- creating the species table followed by ajax script to add and remove species in the table -->
                    <div class="table-responsive">
                        <h4> Species </h4>
                        <br />
                        <form method="post" id="dynamic_form">
                            <span id="result"></span>
                            <table class="table table-bordered table-striped" id="species">
                                <thead>
                                    <tr>
                                        <th>Name *</th>
                                        <th>Quantity *</th>
                                        <th>Height (in metres)</th>
                                        <th>Dimensions</th>
                                        <th>Remarks</th>
                                        <th></th>
                                        <input type="hidden" class="form-control" name="status_species" value="1">
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <input type="hidden" class="form-control" name="status" value="1">
                            <input type="hidden" class="form-control" name="organization" value="{{Auth::user()->organization_id}}">
                            <input type="hidden" class="form-control" name="created_by" value="{{Auth::user()->id}}">
                            <input type="hidden" class="form-control" name="logs" value="0">
                        </form>
                        <div><kbd style="cursor:pointer;"><a title="How To Import As Excel" class="text-white" data-toggle="modal" data-target="#excel2Help">How To Import Excel</a></kbd></div>
                        <div>
                            <label>If data is available as an excel file:</label>
                            <input type="file" id="fileUpload" name="fileUpload" accept=".xks,.xlsx" />
                            <a type="button" name="uploadExcel" id="uploadExcel" class="btn btn-info">Import as Excel</a>
                            <a type="button" name="clear" id="clear" class="btn btn-danger">Clear All</a>
                            <p id="error" class="text-danger"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div style="overflow:auto;">
            <div style="float:right;">
                <button type="button" id="prevBtn" class="btn bd-navbar text-white" onclick="nextPrev(-1)">Previous</button>
                <button type="button" id="nextBtn" class="btn btn-primary" onclick="nextPrev(1)">Next</button>
            </div>
        </div>
        <!-- Circles which indicates the steps of the form: -->
        <div style="text-align:center;margin-top:40px;">
            <span class="step"></span>
            <span class="step"></span>
        </div>
    </form>
</div>

<script type="text/javascript">
    //Species Excel Sheet Import
    $(document).ready(function() {
        let selectedFile;
        console.log(window.XLSX);
        document.getElementById('fileUpload').addEventListener("change", (event) => {
            selectedFile = event.target.files[0];
        })
        let data = [{
            "name": "",
            "quantity": "",
            "height": "",
            "dimensions": "",
            "remarks": ""
        }]
        document.getElementById('uploadExcel').addEventListener("click", () => {
            XLSX.utils.json_to_sheet(data, 'out.xlsx');
            if (selectedFile) {
                let fileReader = new FileReader();
                fileReader.readAsBinaryString(selectedFile);
                fileReader.onload = (event) => {
                    let data = event.target.result;
                    try {
                        let workbook = XLSX.read(data, {
                            type: "binary"
                        });
                    } catch (err) {
                        document.getElementById("error").innerHTML = "Uploaded file format is not xlsx. Please upload in excel format";
                    }
                    let workbook = XLSX.read(data, {
                        type: "binary"
                    });
                    workbook.SheetNames.forEach(sheet => {
                        let exceldata = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheet]);
                        dynamic_species(exceldata.length, exceldata);
                    });
                }
            }
        });
        //District typeAhead
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
        //DYNAMIC SPECIES 
        var count = 1;
        dynamic_species(count, null);

        function dynamic_species(number, exceldata) {
            if (exceldata == null) {
                html = '<tr>';
                html += '<input type="hidden" name="environment_restoration_id[]" class="form-control" value="" />';
                html += '<input type="hidden" name="statusSpecies[]" class="form-control" value="1" />';
                html += '<td><input type="text" id="species_name[]" name="species_name[]" class="form-control typeahead2" /></td>';
                html += '<td><input type="text" id="quantity[]" name="quantity[]" class="form-control" /></td>';
                html += '<td><input type="text" id="height[]" name="height[]" class="form-control" /></td>';
                html += '<td><input type="text" id="dimension[]" name="dimension[]" class="form-control" /></td>';
                html += '<td><input type="text" id="remark[]" name="remark[]" class="form-control" /></td>';
                if (number > 1) {
                    html += '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Remove Species</button></td></tr>';
                    $('tbody').append(html);
                } else {
                    html += '<td><button type="button" name="add" id="add" class="btn btn-success">Add Species</button></td></tr>';
                    $('tbody').html(html);
                }
            } else {
                let name = exceldata[0]['name'];
                let quantity = exceldata[0]['quantity'];
                let height = exceldata[0]['height'];
                let dimensions = exceldata[0]['dimensions'];
                let remarks = exceldata[0]['remarks'];
                document.getElementById("species_name[]").value = name;
                document.getElementById("quantity[]").value = quantity;
                document.getElementById("height[]").value = height;
                document.getElementById("dimension[]").value = dimensions;
                document.getElementById("remark[]").value = remarks;
                for (i = 1; i < (exceldata.length); i++) {
                    name = exceldata[i]['name'];
                    quantity = exceldata[i]['quantity'];
                    height = exceldata[i]['height'];
                    dimensions = exceldata[i]['dimensions'];
                    remarks = exceldata[i]['remarks'];
                    html = '<tr>';
                    html += '<input type="hidden" id="environment_restoration_id" name="environment_restoration_id[]" class="form-control"  />';
                    html += '<input type="hidden" id="status_species" name="statusSpecies[]" class="form-control" value="1" />';
                    html += '<td><input type="text" id="species_name[]" name="species_name[]" class="form-control typeahead2" value=' + name + ' /></td>';
                    html += '<td><input type="text" id="quantity[]" name="quantity[]" class="form-control" value=' + quantity + ' /></td>';
                    html += '<td><input type="text" id="height[]" name="height[]" class="form-control" value=' + height + ' /></td>';
                    html += '<td><input type="text" id="dimension[]" name="dimension[]" class="form-control" value=' + dimensions + ' /></td>';
                    html += '<td><input type="text" id="remark[]" name="remark[]" class="form-control" value=' + remarks + ' /></td>';
                    if (number > 1) {
                        html += '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Remove Species</button></td></tr>';
                        $('tbody').append(html);
                    } else {
                        html += '<td><button type="button" name="add" id="add" class="btn btn-success">Add Species</button></td></tr>';
                        $('tbody').html(html);
                    }
                }
            }
            var path2 = "{{route('species')}}";
            $('input.typeahead2').typeahead({
                source: function(terms, process) {
                    return $.get(path2, {
                        terms: terms
                    }, function(data) {
                        console.log(data);
                        objects = [];
                        data.map(i => {
                            objects.push(i.title)
                        })
                        console.log(objects);
                        return process(objects);
                    })
                },
            });
        }
        $(document).on('click', '#add', function() {
            count++;
            dynamic_species(count);
        });
        $(document).on('click', '.remove', function() {
            count--;
            $(this).closest("tr").remove();
        });
        document.getElementById('clear').addEventListener("click", () => {
            console.log(count);
            var table = document.getElementById("species");
            while (table.rows.length > 2) {
                table.deleteRow(2);
            }
            count = 1;
            document.getElementById("species_name[]").value = "";
            document.getElementById("quantity[]").value = "";
            document.getElementById("height[]").value = "";
            document.getElementById("dimension[]").value = "";
            document.getElementById("remark[]").value = "";
        });
        $('#dynamic_species').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: '{{ route("store.dynamic-species") }}',
                method: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function() {
                    $('#save').attr('disabled', 'disabled');
                },
                success: function(data) {
                    if (data.error) {
                        var error_html = '';
                        for (var count = 0; count < data.error.length; count++) {
                            error_html += '<p>' + data.error[count] + '</p>';
                        }
                        $('#result').html('<div class="alert alert-danger">' + error_html + '</div>');
                    } else {
                        dynamic_field(1);
                        $('#result').html('<div class="alert alert-success">' + data.success + '</div>');
                    }
                    $('#save').attr('disabled', false);
                }
            })
        });
    });
    ///STEPPER
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab
    function showTab(n) {
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Submit";
        } else {
            document.getElementById("nextBtn").innerHTML = "Next";
        }
        //... and run a function that will display the correct step indicator:
        fixStepIndicator(n)
    }

    function nextPrev(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form...
        if (currentTab >= x.length) {
            // ... the form gets submitted:
            document.getElementById("envForm").submit();
            return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByClassName("verifythis");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
                // add an "invalid" class to the field:
                y[i].className += " invalid";
                // and set the current valid status to false
                valid = false;
            }
        }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid; // return the valid status
    }

    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class on the current step:
        x[n].className += " active";
    }
    /// SCRIPT FOR THE MAP
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
    //map tiles are ???square bitmap graphics displayed in a grid arrangement to show a map.???
    //There are a number of different tile providers (or tileservers), some are free and open source. We are using OSM
    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Data ?? <a href="http://osm.org/copyright">OpenStreetMap</a>',
            maxZoom: 18
        }).addTo(map);
    //we???re calling tilelayer() to create the tile layer, passing in the OSM URL first, then the second argument is an object containing the options for our new tile 
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
        //$('#kml').val(tokml(drawnItems.toGeoJSON()));
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