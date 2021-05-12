@extends('approvalItem::approval')
@section('theme')
<div class="container bg-white">
    <div class="row p-4 bg-white">
        <h4>Assigning Organization to {{$process_item->form_type->type}} application no {{$process_item->form_id}} logged on {{date('d-m-Y',strtotime($item->created_at))}}</h4>
    </div>
</div>
@endsection
@section('approval')
<br>
<h5 >Assigning Organizations</h5>
<hr>
<div class="container">
    <div class="container">
        <div class="row p-4 bg-white">
            <h6>Change Assigned Organization</h6>
        </div>
        <div class="row p-4 bg-white">
            <div class="row justify-content-center">
                <table>
                    <tr>
                        <td>
                            <form action="/approval-item/assignorganization" method="post">
                            @csrf
                            <select name="filter" class="custom-select" required>
                                <option value="0" selected>Activity</option>
                                @foreach($Activities as $activity)
                                <option value="{{$activity->id}}">{{$activity->activity}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="hidden" class="form-control" name="type" value="1">
                            <input type="hidden" class="form-control" name="id" value="{{ $process_item->id }}">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-filter mr-1"></i></button>
                            </form>
                        </td>
                        <td>
                            <form action="/approval-item/assignorganization" method="post">
                            @csrf
                            <select name="filter" class="custom-select" required>
                                <option value="0" selected>Province</option>
                                @foreach($Provinces as $province)
                                <option value="{{$province->id}}">{{$province->province}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="hidden" class="form-control" name="id" value="{{ $process_item->id }}">
                            <input type="hidden" class="form-control" name="type" value="2">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-filter mr-1"></i></button>
                            </form>
                        </td>
                        <td>
                            <button type="submit" class="btn btn-primary" ><a href="/approval-item/assignorganization/{{$process_item->id}}" class="text-dark">Reset</a></button>
                        </td>
                    <tr>
                </table>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row p-4 bg-white">
            <div class="col border border-muted rounded-lg mr-2 p-4">       
                <p>System registered Organizations</p>
                <table class="table  border-secondary rounded-lg mr-4">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Change</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Organizations as $organization)
                        <tr>
                            <td>{{$organization->title}}</td>
                            <td><a href="/approval-item/changeassignOrganization/{{$organization->id}}/{{$process_item->id}}" class="text-dark">assign</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col border border-muted rounded-lg mr-2 p-4">
                <p>Non registered Organizations</p>
                <form action="\approval-item\changeassignOrganization" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Organization name" name="organization" value="{{ old('organization') }}"/>
                        @error('organization')
                            <div class="alert">                                   
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror 
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Organization email" name="email" value="{{ old('email') }}"/>
                        @error('email')
                            <div class="alert">                                   
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror 
                        <input type="hidden" class="form-control" name="create_by" value="{{ Auth::user()->id }}">
                        <input type="hidden" class="form-control" name="create_organization" value="{{ Auth::user()->organization_id }}">
                        <input type="hidden" class="form-control" name="process_id" value="{{ $process_item->id }}">
                    </div>
                    <div class="form-check">
                        <button type="submit" class="btn btn-primary" >Assign</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row p-4 bg-white">
            <div class="col border border-muted rounded-lg mr-2 p-4">
                <h6>Reject Application<h6>
                <form action="\approval-item\finalapproval\" method="post">
                    @csrf
                    <h6>Reason for rejection</h6>
                    <div class="input-group mb-3">
                    </br>
                        <textarea  class="form-control" rows="3" name="request"></textarea>
                        @error('request')
                            <div class="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                        <input type="hidden" class="form-control" name="create_by" value="{{ Auth::user()->id }}">
                        <input type="hidden" class="form-control" name="create_organization" value="{{ Auth::user()->organization_id }}">
                        <input type="hidden" class="form-control" name="process_id" value="{{ $process_item->id }}">
                        <input type="hidden" class="form-control" name="status" value="4">
                    </div>
                    <div class="form-check">
                        <button type="submit" class="btn btn-primary" >Reject</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection