@extends('approvalItem::approval')

@section('theme')
<div class="container bg-white">
    <div class="row p-4 bg-white">
        @if($process_item->prerequisite == 0)
            <h4>Assigning staff to {{$process_item->form_type->type}} application no {{$process_item->form_id}} logged on {{date('d-m-Y',strtotime($item->created_at))}}</h4>
        @elseif($process_item->prerequisite == 1)
            <h4>Assigning staff to additional investigation request for {{$process_item->form_type->type}} no {{$process_item->form_id}} logged on {{date('d-m-Y',strtotime($item->created_at))}} by {{$process_item->requesting_organization->title}}</h4>
        @endif
    </div>
</div>
@endsection

@section('approval')
<div class="container bg-white">
        <div class="row p-4 bg-white">
            <div class="col border border-muted rounded-lg mr-2 p-4">
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
                        <textarea  class="form-control" rows="3" name="request"></textarea>
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
            <div class="col border border-muted rounded-lg mr-2 p-4">
                <h6>Assign staff member</h6>
                <table class="table table-light table-striped border-secondary rounded-lg mr-4">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>name</th>
                            <th>email</th>
                            <th>assign</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td><a href="/approval-item/confirmassign/{{$user->id}}/{{$process_item->id}}" class="text-muted">assign</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</div>
@endsection