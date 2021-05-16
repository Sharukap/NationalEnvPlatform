@extends('general')

@section('general')

<div class="container">

  <!-- FAQ button -->
  <div class="d-flex mb-2 justify-content-end">
    <span class="mr-3" style="font-size:20px;"><strong>* means required field </strong></span>
    <span><kbd><a title="FAQ" class="text-white" data-toggle="modal" data-target="#treeHelp">HELP</a></kbd></span>
  </div>
  @include('faq')
  <form action="/tree-removal/save" method="post" id="regForm" enctype="multipart/form-data" autocomplete="off">
    @csrf
    <!-- One "tab" for each step in the form: -->
    <div class="tab">
      <div class="container">
        <div class="row border rounded-lg p-4 bg-white">

          <div class="col border border-muted rounded-lg mr-2 p-2">

            <div class="row p-2">

              <div class="col p-2">
                <div class="form-group">
                  District*<input type="text" class="form-control typeahead2 @error('district') is-invalid @enderror" value="{{ old('district') }}" placeholder="Required Search" name="district" />
                  @error('district')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col p-2">
                <div class="form-group">
                  GS Division*<input type="text" class="form-control typeahead4 @error('gs_division') is-invalid @enderror" value="{{ old('gs_division') }}" placeholder="Required Search" name="gs_division" />
                  @error('gs_division')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
            @if(Auth::user()->role_id !=6) 
            <div class="form-group">
              <label for="organization">Activity Organization (Optional)</label>
              <select class="custom-select @error('organization') is-invalid @enderror" name="organization">
                <option selected value="">Select Organization</option>
                @foreach ($organizations as $organization)
                <option value="{{ $organization->id }}" {{ Request::old()?(Request::old('organization')==$organization->id?'selected="selected"':''):'' }}>{{ $organization->title }}</option>
                @endforeach
              </select>
              @error('organization')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
            @endif
            <br>
            <hr>
            <!-- MAP CONTENT -->
            <h4>Land Parcel Details</h4>

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
              <input type="text" class="form-control typeahead3" value="{{ old('land_extent') }}" id="land_extent" name="land_extent">
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

            @if(Auth()->user()->role_id != 6)
            <div>
              <label>Upload KML File</label>
              <input type="file" name="select_file" id="select_file" />
              <input type="button" name="upload" id="upload" class="btn btn-primary" value="Upload">
            </div>
            <div class="alert mt-3" id="message" style="display: none"></div>
            @endif
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
              <label class="custom-control-label" for="customCheck"><strong>Click if Land is a Protected Area.</strong></label>
            </div>

            <!-- saving the coordinates of the kml file -->
            <input id="polygon" type="hidden" name="polygon" class="form-control @error('polygon') is-invalid @enderror" value="{{request('polygon')}}" />

            <!-- Saving the KML file in storage -->
            <input id="kml" type="hidden" name="kml" class="form-control" value="{{request('kml')}}" />

          </div>
          <div class="col border border-muted rounded-lg">
            <div class="row p-2 mt-2">
              <div class="col">
                <div class="form-group">
                  <label for="number_of_trees">Number of Trees*</label>
                  <input type="text" class="form-control @error('number_of_trees') is-invalid @enderror" value="{{ old('number_of_trees') }}" id="number_of_trees" name="number_of_trees" placeholder="Required">
                  @error('number_of_trees')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="number_of_tree_species">Number of Tree Species</label>
                  <input type="text" class="form-control" id="number_of_tree_species" name="number_of_tree_species">
                  @error('number_of_tree_species')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="number_of_flora_species">Number of Flora Species</label>
                  <input type="text" class="form-control" id="number_of_flora_species" name="number_of_flora_species">
                  @error('number_of_flora_species')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="number_of_reptile_species">Number of Reptile Species</label>
                  <input type="text" class="form-control" id="number_of_reptile_species" name="number_of_reptile_species">
                  @error('number_of_reptile_species')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="col">
                <div class="form-group">
                  <label for="number_of_mammal_species">Number of Mammal Species</label>
                  <input type="text" class="form-control" id="number_of_mammal_species" name="number_of_mammal_species">
                  @error('number_of_mammal_species')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="number_of_amphibian_species">Number of Ambhibian Species</label>
                  <input type="text" class="form-control" id="number_of_amphibian_species" name="number_of_amphibian_species">
                  @error('number_of_amphibian_species')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="number_of_fish_species">Number of Fish Species</label>
                  <input type="text" class="form-control" id="number_of_fish_species" name="number_of_fish_species">
                  @error('number_of_fish_species')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="number_of_avian_species">Number of Avian Species</label>
                  <input type="text" class="form-control" id="number_of_avian_species" name="number_of_avian_species">
                  @error('number_of_avian_species')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>

            </div>
            <div class="form-group">
              <label for="species_special_notes">Species Special Notes</label>
              <textarea class="form-control" rows="1" id="species_special_notes" name="species_special_notes"></textarea>
            </div>

            <div class="form-group">
              <label for="description">Description*</label>
              <textarea class="form-control @error('description') is-invalid @enderror" rows="2" id="description" placeholder="Required" name="description">{{{ old('description') }}}</textarea>
              @error('description')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group" id="dynamicAddRemove">
              <label for="images">Photos (Optional)</label>

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
      </div>
    </div>
    <div class="tab">
      <div class="container">
        <div class="row border rounded-lg p-4 bg-white">
          @error('location.*.tree_species_id')
          <div class="alert alert-danger">The Tree Species Field Is Required</div>
          @enderror
          @error('location.*.width_at_breast_height')
          <div class="alert alert-danger">The Width At Breast Height Field Is Required</div>
          @enderror
          @error('location.*.height')
          <div class="alert alert-danger">The Height Field Is Required</div>
          @enderror
          <table class="table" id="dynamicAddRemoveTable">
            <tr>
              <th>No.</th>
              <th>Species*</th>
              <th>Tree ID</th>
              <th>Width at Breast Height*</th>
              <th>Height*</th>
              <th>Timber Volume</th>
              <th>Cubic Feet</th>
              <th>Age</th>
            </tr>
            <tr>
              <td>1</td>
              <td><input type="text" id="species_name" name="location[0][tree_species_id]" placeholder="Required" class="form-control typeahead6 @error('location.0.tree_species_id') is-invalid @enderror" /></td>
              <td><input type="text" id="tree_id" name="location[0][tree_id]" class="form-control" /></td>
              <td><input type="text" id="width_at_breast_height" name="location[0][width_at_breast_height]" placeholder="Required" class="form-control @error('location.0.width_at_breast_height') is-invalid @enderror" /></td>
              <td><input type="text" id="height" name="location[0][height]" placeholder="Required" class="form-control @error('location.0.height') is-invalid @enderror" /></td>
              <td><input type="text" id="timber_volume" name="location[0][timber_volume]" class="form-control" /></td>
              <td><input type="text" id="timber_cubic" name="location[0][timber_cubic]" class="form-control" /></td>
              <td><input type="text" id="age" name="location[0][age]" class="form-control" /></td>
              <td rowspan="2"><button type="button" name="add" id="add-btn" class="btn bd-navbar text-white">Add</button></td>
            </tr>
            <tr>
              <td colspan="7"><textarea id="remarks" name="location[0][remark]" placeholder="Optional Remark" class="form-control" rows="3"></textarea></td>
            </tr>
          </table>
          <div>
          <label>If data is available as an excel file:</label>
            <input type="file" id="fileUpload" name="fileUpload" accept=".xks,.xlsx" />
            <a type="button" name="uploadExcel" id="uploadExcel" class="btn btn-info">Import as Excel</a>
            <a type="button" name="clear" id="clear" class="btn btn-danger">Clear All</a>
            <p><strong>When importing excel, Ensure that the field names are as shown above in terms of whitespaces and letter case</strong></p>
            <p id="error" class="text-danger"></p>
          </div>
        </div>
      </div>
    </div>
    <br>
    <div style="overflow:auto;">
      <div style="float:right;">
        <button type="button" id="prevBtn" class="btn bd-navbar text-white" onclick="nextPrev(-1)">Previous</button>
        <button type="button" id="nextBtn" class="btn bd-navbar text-white" onclick="nextPrev(1)">Next</button>
      </div>
    </div>
    <!-- Circles which indicates the steps of the form: -->
    <div style="text-align:center;margin-top:40px;">
      <span class="step"></span>
      <span class="step"></span>
    </div>
    <input type="hidden" class="form-control" name="createdBy" value="{{Auth::user()->id}}">
  </form>
</div>


<script>
  let i = 0;

  //Excel Import Script  
  let selectedFile;
  console.log(window.XLSX);
  document.getElementById('fileUpload').addEventListener("change", (event) => {
    selectedFile = event.target.files[0];
  })

  let data = [{
    "species": "",
    "tree_id": "",
    "width_at_breast_height": "",
    "height": "",
    "timber_volume": "",
    "cubic_feet": "",
    "age": "",
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
          console.log(exceldata);

          document.getElementById("species_name").value = exceldata[i]['Species'];
          document.getElementById("tree_id").value = exceldata[i]['Tree ID'];
          document.getElementById("width_at_breast_height").value = exceldata[i]['Width at Breast Height'];
          document.getElementById("height").value = exceldata[i]['Height'];
          document.getElementById("timber_volume").value = exceldata[i]['Timber Volume'];
          document.getElementById("timber_cubic").value = exceldata[i]['Cubic Feet'];
          document.getElementById("age").value = exceldata[i]['Age'];
          document.getElementById("remarks").value = exceldata[i]['Remarks'];

          for (j = 0; j < exceldata.length; j++) {
            i++;
            species = exceldata[i]['Species'];
            tree_id = exceldata[i]['Tree ID'];
            width_breast = exceldata[i]['Width at Breast Height'];
            height = exceldata[i]['Height'];
            timber_volume = exceldata[i]['Timber Volume'];
            cubic_feet = exceldata[i]['Cubic Feet'];
            age = exceldata[i]['Age'];
            remarks = exceldata[i]['Remarks'];
            $("#dynamicAddRemoveTable").append(
              '<tr><td>' + (i + 1) + '</td><td><input type="text" id="species_name" name="location[' + i + '][tree_species_id]" placeholder="Enter Species" class="form-control typeahead6" value=' + species + ' /></td>\
      <td><input type="text" id="tree_id" name="location[' + i + '][tree_id]" placeholder="Tree ID" class="form-control" value=' + tree_id + ' /></td>\
      <td><input type="text" id="width_at_breast_height" name="location[' + i + '][width_at_breast_height]" placeholder="Enter Width" class="form-control" value=' + width_breast + ' /></td>\
      <td><input type="text" id="height" name="location[' + i + '][height]" placeholder="Enter Height" class="form-control" value=' + height + ' /></td>\
      <td><input type="text" id="timber_volume" name="location[' + i + '][timber_volume]" placeholder="Enter Volume" class="form-control" value=' + timber_volume + ' /></td>\
      <td><input type="text" id="timber_cubic" name="location[' + i + '][timber_cubic]" placeholder="Enter Cubic" class="form-control" value=' + cubic_feet + ' /></td>\
      <td><input type="text" id="age" name="location[' + i + '][age]" placeholder="Enter Age" class="form-control" value=' + age + ' /></td></td>\
      <td><button type="button" class="btn btn-danger remove-tr">Remove</button></td>\
      </tr><tr><td colspan="7"><textarea id="remarks" name="location[' + i + '][remark]" placeholder="Optional Remarks" class="form-control" rows="3">' + remarks + '</textarea></td></tr>'
            );
          }
        });
      }
    }
  });

  /// SCRIPT FOR THE DYNAMIC COMPONENT
  $("#add-btn").click(function() {
    ++i;
    $("#dynamicAddRemoveTable").append(
      '<tr><td>' + (i + 1) + '</td><td><input type="text" id="species_name' + i + '" name="location[' + i + '][tree_species_id]" placeholder="Required" class="form-control typeahead6"/></td>\
      <td><input type="text" id="tree_id' + i + '" name="location[' + i + '][tree_id]" class="form-control" /></td>\
      <td><input type="text" id="width_at_breast_height' + i + '" name="location[' + i + '][width_at_breast_height]" placeholder="Required" class="form-control" /></td>\
      <td><input type="text" id="height' + i + '" name="location[' + i + '][height]" placeholder="Required" class="form-control" /></td>\
      <td><input type="text" id="timber_volume' + i + '" name="location[' + i + '][timber_volume]" class="form-control" /></td>\
      <td><input type="text" id="timber_cubic' + i + '" name="location[' + i + '][timber_cubic]" class="form-control" /></td>\
      <td><input type="text" id="age' + i + '" name="location[' + i + '][age]" class="form-control" /></td></td>\
      <td><button type="button" class="btn btn-danger remove-tr">Remove</button></td>\
      </tr><tr><td colspan="7"><textarea id="remarks' + i + '" name="location[' + i + '][remark]" placeholder="Optional Remark" class="form-control" rows="3">\
      </textarea></td></tr>'
    );
    var path6 = "{{route('species')}}";
    $('input.typeahead6').typeahead({
      source: function(terms, process) {

        return $.get(path6, {
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
  });
  $(document).on('click', '.remove-tr', function() {
    $(this).parents('tr').next('tr').remove()
    $(this).parents('tr').remove();
  });

  document.getElementById('clear').addEventListener("click", () => {
    var table = document.getElementById("dynamicAddRemoveTable");

    while (table.rows.length > 3) {
      table.deleteRow(2);
    }
    i = 1;
    document.getElementById("species_name").value = "";
    document.getElementById("tree_id").value = "";
    document.getElementById("width_at_breast_height").value = "";
    document.getElementById("height").value = "";
    document.getElementById("timber_volume").value = "";
    document.getElementById("timber_cubic").value = "";
    document.getElementById("age").value = "";

    document.getElementById("remarks").value = "";
  });

  //STEPPER
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
      document.getElementById("regForm").submit();
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

  var path6 = "{{route('species')}}";
  $('input.typeahead6').typeahead({
    source: function(terms, process) {

      return $.get(path6, {
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


  ///MAP ACTIVITIES
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
    $('#polygon').val(JSON.stringify(drawnItems.toGeoJSON()));

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
    var data = new FormData(document.getElementById("regForm"));
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
        $('#loc').val(JSON.stringify(tmp));
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
          alert('You should not upload files exceeding 4 MB. Please compress files size and upload again');
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