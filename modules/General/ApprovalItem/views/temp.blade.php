@extends('general')

@section('general')
<h3 class="p-3 display-4">Investigation of request</h3>
<hr>
<span>
    <h3 class="text-center bg-success text-light">{{session('message')}}</h3>
    <h3 class="text-center bg-warning text-light">{{session('warning')}}</h3>
</span>
<div class="row justify-content-between">
    <div class="col-md-12">
    @switch($process_item->form_type_id)
    @case('1')
        <h6>Tree cutting request details</h6>
        <table class="table table-dark table-striped border-secondary rounded-lg mr-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Province</th>
                    <th>District</th>
                    <th>GS Division</th>
                    <th>Special approval</th>
                    <th>Date application made</th>
                    <th>Land size</th>
                    <th>unit</th>
                    <th>No of Trees</th>
                    <th>No of Tree Species</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$item->id}}</td>
                    @if($item->province == NULL)
                    <td>Unassigned</td>
                    @else
                    <td>{{$item->province->province}}</td>
                    @endif 
                    @if($item->district == NULL)
                    <td>Unassigned</td>
                    @else
                    <td>{{$item->district->district}}</td>
                    @endif 
                    @if($item->gs_division == NULL)
                    <td>Unassigned</td>
                    @else
                    <td>{{$item->gs_division->gs_division}}</td>
                    @endif
                    @if($item->special_approval==0)
                        <td>Not a protected area</td>
                    @elseif($item->special_approval==1)
                        <td>Protected area</td>
                    @endif
                    <td>{{date('d-m-Y',strtotime($item->created_at))}}</td>
                    <td>{{$item->land_size}}</td>
                    <td>{{$item->no_of_trees}}</td>
                    <td>{{$item->no_of_tree_species}}<td>
                </tr>
            </tbody>
        </table>
        <h6>Additional Data</h6>
        <table class="table table-dark table-striped border-secondary rounded-lg mr-4">
                <thead>
                    <tr>
                        <th>Number of Mamal Species</th>
                        <th>Number of Amphibian Species</th>
                        <th>Number of Reptile Species</th>
                        <th>Number of Avian Species</th>
                        <th>Number of Flora Species</th>
                        <th>Tree Species special notes</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$item->no_of_mammal_species}}</td>
                        <td>{{$item->no_of_amphibian_species}}</td>
                        <td>{{$item->no_of_reptile_species}}</td>
                        <td>{{$item->no_of_avian_species}}</td>
                        <td>{{$item->no_of_flora_species}}</td>
                        <td>{{$item->species_special_notes}}</td>
                    </tr>
                </tbody>
        </table>
        <br>
        <h6>Tree Data</h6>
            @if($tree_data==NULL)
                <h1>No data</h1>
            @else
        <table class="table table-dark table-striped border-secondary rounded-lg mr-4">
            <thead>
                    <tr>
                        <th>Tree Species ID</th>
                        <th>Tree ID</th>
                        <th>Width at Breast Height</th>
                        <th>Height</th>
                        <th>Timber Volume</th>
                        <th>Timber Cubic</th>
                        <th>Age</th>
                        <th>Remark</th>
                    </tr>
                </thead>
                <tbody>
                @for($x = 0; $x < count($tree_data); $x++)<tr>
                        <td>{{$tree_data[$x]['tree_species_id']}}</td>
                        <td>{{$tree_data[$x]['tree_id']}}</td>
                        <td>{{$tree_data[$x]['width_at_breast_height']}}</td>
                        <td>{{$tree_data[$x]['height']}}</td>
                        <td>{{$tree_data[$x]['timber_volume']}}</td>
                        <td>{{$tree_data[$x]['timber_cubic']}}</td>
                        <td>{{$tree_data[$x]['age']}}</td>
                        <td>{{$tree_data[$x]['remark']}}</td>
                    </tr>@endfor
                </tbody>
        </table>
        @endif
    @break
    @case('2')
        <h6>Development project information</h6>
        <table class="table table-dark table-striped border-secondary rounded-lg mr-4">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Gazzete</th>
                    <th>Protected Area</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$item->title}}</td>
                    <td>{{$item->gazette->title}}</td>
                    <td>{{$item->protected_area}}</td>               
                </tr>
            </tbody>
        </table>
    @break
    @case('4')
        <h6>item information</h6>
        <table class="table table-dark table-striped border-secondary rounded-lg mr-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>item type</th>
                    <th>description</th>
                    <th>Location</th>
                    <th>Date complained logged</th>
                    <th>Photos</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->crime_type->type}}</td>
                    <td>{{$item->description}}</td>
                    <td>...</td>
                    <td>{{date('d-m-Y',strtotime($item->created_at))}}</td>
                    <td><img src="{{ asset('\storage\itemEvidence\WhatsApp Image 2021-01-02 at 16.49.22.jpeg') }}" alt="photo" width="80" /> </td>
                    <td>{{$item->status}}</td>
                </tr>
            </tbody>
        </table>
    @break
    @endswitch
    <h5>Map Location</h5>
    <div id="mapid" style="height:400px;" name="map"></div>
    </div>
</div>
</br>
<hr>
</br>
<div class="row justify-content-between">
    <div class="col-md-8">
        <h6>Progress</h6>
        <table class="table table-dark table-striped border-secondary rounded-lg mr-4">
            <thead>
                <tr>
                    <th>Authority responsible</th>
                    <th>Remark</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            @foreach($Process_item_progresses as $Process_item_progress)<tr>
                    <td>{{$Process_item_progress->User->name}}</td>
                    <td>{{$Process_item_progress->remark}}</td>
                    <td>{{$Process_item_progress->Status->status_title}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</br>
<hr>
</br>
<div class="row justify-content-between">
    <div class="col-md-8">
        <h6>Prerequisites</h6>
        <table class="table table-dark table-striped border-secondary rounded-lg mr-4">
            <thead>
                <tr>
                    <th>Requested by</th>
                    <th>Assigned Organization</th>
                    <th>remarks</th>
                    <th>status</th>
                    <th>Cancel</th>
                </tr>
            </thead>
            <tbody>
            @foreach($Prerequisites as $prerequisite)<tr>
                    <td>{{$prerequisite->created_by_user->name}}</td>
                    <td>{{$prerequisite->Activity_organization->title}}</td>
                    <td>{{$prerequisite->remark}}</td>
                    <td>{{$prerequisite->status->type}}</td>
                    <td><a href="/approval-item/cancelprerequisite/{{$prerequisite->id}}/{{ Auth::user()->id }}" class="text-muted">Cancel</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<hr>
</br>
<div class="row justify-content-between">
    @isset($Related_Treecuts)    
    <div class="col-md-8">
        <h6>Tree removals in the same land Parcel</h6>
        <table class="table table-dark table-striped border-secondary rounded-lg mr-4">
            <thead>
                <tr>
                    <th>Land Size</th>
                    <th>No of trees</th>
                    <th>No of tree species</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($Related_Treecuts as $related_treecut)<tr>
                    <td>{{$related_treecut->land_size}}</td>
                    <td>{{$related_treecut->no_of_trees}}</td>
                    <td>{{$related_treecut->no_of_tree_species}}</td>
                    <td>{{date('d-m-Y',strtotime($related_treecut->created_at))}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endisset
</div>
<hr>
</br>
<div class="row justify-content-between">
    @isset($Related_Devps)    
    <div class="col-md-8">
        <h6>Development Project in the same land Parcel</h6>
        <table class="table table-dark table-striped border-secondary rounded-lg mr-4">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Gazette Title</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($Related_Devps as $related_devp)<tr>
                    <td>{{$related_devp->title}}</td>
                    <td>{{$related_devp->gazette->title}}</td>
                    <td>{{date('d-m-Y',strtotime($related_devp->created_at))}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endisset
</div>
<hr>
</br>
<div class="row justify-content-between">
    @isset($Related_Crimes)    
    <div class="col-md-8">
        <h6>Crime reports in the same land Parcel</h6>
        <table class="table table-dark table-striped border-secondary rounded-lg mr-4">
            <thead>
                <tr>
                    <th>Crime by</th>
                    <th>Description</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($Related_Crimes as $related_crime)<tr>
                    <td>{{$related_crime->crime_type->type}}</td>
                    <td>{{$related_crime->description}}</td>
                    <td>{{date('d-m-Y',strtotime($related_crime->created_at))}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endisset
</div>
<hr>
</br>
<div class="row justify-content-between">
    <div class="col-md-8">
        <h6>Request additional investigation</h6>
        <br>
        <form action="\approval-item\createprerequisite" method="post">
            @csrf
            <h6>Select Organization in charge</h6>
            <div class="input-group mb-3">
            <select name="organization" class="custom-select">
                <option value="0" selected>Select Organization</option>
            @foreach($Organizations as $organization)         
                <option value="{{$organization->id}}">{{$organization->title}}</option>
            @endforeach
            </select>
            @error('organization')
                <div class="alert">                                   
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
            </div>
            <h6>Request</h6>
            <div class="input-group mb-3">
            </br>
                <textarea  class="form-control" rows="3" name="request">
                </textarea>
                @error('request')
                    <div class="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
                <input type="hidden" class="form-control" name="create_by" value="{{ Auth::user()->id }}">
                <input type="hidden" class="form-control" name="create_organization" value="{{ Auth::user()->organization_id }}">
                <input type="hidden" class="form-control" name="process_id" value="{{ $process_item->id }}">
            </div>
            <div class="form-check">
                <button type="submit" class="btn btn-primary" >Submit</button>
            </div>
        </form>
    </div>
</div>
<hr>
</br>
@if(Auth::user()->role_id == 5)
<div class="row justify-content-between">
    <div class="col-md-8">
        <h6>Save investigation progress</h6>
        <br>
        <form action="\approval-item\progresssave\" method="post">
            @csrf
            <h6>Remark</h6>
            <div class="input-group mb-3">
            </br>
                <textarea  class="form-control" rows="3" name="request">
                </textarea>
                @error('request')
                    <div class="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
                <input type="hidden" class="form-control" name="create_by" value="{{ Auth::user()->id }}">
                <input type="hidden" class="form-control" name="create_organization" value="{{ Auth::user()->organization_id }}">
                <input type="hidden" class="form-control" name="process_id" value="{{ $process_item->id }}">
            </div>
            <h6>Status</h6>
            <div class="input-group mb-3">
                <select name="status" class="custom-select">
                    <option value="0" selected>Select Status</option>
                    @foreach($Process_item_statuses as $process_item_status)         
                    <option value="{{$process_item_status->id}}">{{$process_item_status->status_title}}</option>
                    @endforeach
                </select>
                @error('status')
                <div class="alert">                                   
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>
            <div class="form-check">
                <button type="submit" class="btn btn-primary" >Update</button>
            </div>
        </form>
    </div>
</div>
@endif
@if(Auth::user()->role_id == 3 || Auth::user()->role_id == 4)
<div class="row justify-content-between">
    <div class="col-md-8">
        <h6>Final Approval</h6>
        <br>
        <form action="\approval-item\finalapproval\" method="post">
            @csrf
            <h6>Remark</h6>
            <div class="input-group mb-3">
            </br>
                <textarea  class="form-control" rows="3" name="request">
                </textarea>
                @error('request')
                    <div class="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
                <input type="hidden" class="form-control" name="create_by" value="{{ Auth::user()->id }}">
                <input type="hidden" class="form-control" name="create_organization" value="{{ Auth::user()->organization_id }}">
                <input type="hidden" class="form-control" name="process_id" value="{{ $process_item->id }}">
            </div>
            <h6>Status</h6>
            <div class="input-group mb-3">
                <select name="status" class="custom-select">
                    <option value="0" selected>Select Status</option>         
                    <option value="4">Not Approved</option>
                    <option value="5">Approved</option>
                </select>
                @error('status')
                <div class="alert">                                   
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>
            <div class="form-check">
                <button type="submit" class="btn btn-primary" >Update</button>
            </div>
        </form>
    </div>
</div>
@endif
<script type="text/javascript">
    var center = [7.2906, 80.6337];

    // Create the map
    var map = L.map('mapid').setView(center, 10);

    // Set up the OSM layer 
    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Data © <a href="http://osm.org/copyright">OpenStreetMap</a>',
            maxZoom: 18
        }).addTo(map);

    // add a marker in the given location
    L.marker(center).addTo(map);

    //FROM LARAVEL THE COORDINATES ARE BEING TAKEN TO THE SCRIPT AND CONVERTED TO JSON
    var polygon = @json($polygon);
    console.log(polygon);

    //ADDING THE JSOON COORDINATES TO MAP
    L.geoJSON(JSON.parse(polygon)).addTo(map);
    
</script> 
@endsection