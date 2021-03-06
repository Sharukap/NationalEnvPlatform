@extends('approvalItem::approval')
@section('theme')
<div class="container bg-white">
    <div class="row p-4 bg-white">
        @if($process_item->prerequisite == 0)
            <h4>Investigating {{$process_item->form_type->type}} application no {{$process_item->form_id}} logged on {{date('d-m-Y',strtotime($item->created_at))}}</h4>
        @elseif($process_item->prerequisite == 1)
            <h4>Investigation for additional investigation request for {{$process_item->form_type->type}} no {{$process_item->form_id}} logged on {{date('d-m-Y',strtotime($item->created_at))}} by {{$process_item->requesting_organization->title}}</h4>
        @endif
        @if($process_item->activity_user_id != null)
            <h4>Staff Member assigned:- {{$process_item->activity_user->name}}</h4>
        @endif
    </div>
</div>
@endsection
@section('approval')

<div class="container bg-white">
    @if($process_item->prerequisite == 1)
        <div class="row p-4 bg-white">
            <h4>Request Remark {{$process_item->remark}}</h4>
        </div>
    @endif
        <div class="row p-4 bg-white">
            <h6>Prerequisites</h6>
            <hr>
        </div>
        <div class="row p-4 bg-white">
            <div class="col border border-muted rounded-lg mr-2 p-4">
                <h6>Current Prerequisites</h6>
                @if (count($Prerequisites) > 0)
                    <table class="table table-light table-striped border-secondary rounded-lg mr-4">
                        <thead>
                            <tr>
                                <th>Requested by</th>
                                <th>Assigned Organization</th>
                                <th>remarks</th>
                                @if(($process_item->activity_user_id == Auth::user()->id || ($process_item->activity_organization ==Auth::user()->organization_id && Auth::user()->role_id == 4)) && $process_item->status_id != 8)
                                    <th>More Details</th>
                                @else
                                    <th>status</th>
                                @endif
                                <th>Cancel Prerequisite<th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Prerequisites as $prerequisite)<tr>
                                @if($prerequisite->created_by_user_id ==null)
                                    <td>not available</td>
                                @else
                                    <td>{{$prerequisite->created_by_user->name}}</td>
                                @endif
                                    <td>{{$prerequisite->Activity_organization->title}}</td>
                                    <td>{{$prerequisite->remark}}</td>
                                    @if(($process_item->activity_user_id == Auth::user()->id || ($process_item->activity_organization ==Auth::user()->organization_id && Auth::user()->role_id == 4)) && $process_item->status_id != 8)    
                                        <td><a href="/approval-item/prerequisiteprogress/{{$prerequisite->id}}" class="text-muted">view</a></td>
                                    @else
                                        <td>{{$prerequisite->status->type}}</td>
                                    @endif
                                    @if($prerequisite->status_id != 8)
                                        <td><a href="/approval-item/cancelprerequisite/{{$prerequisite->id}}/{{ Auth::user()->id }}" class="text-muted" onclick="return prereqCancel();">Cancel</a></td>
                                    @else
                                    <td>Cancelled already<td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
                @if (count($Prerequisites) < 1)
                    <p>No prerequisites made yet</p>
                @endif
            </div>
            @if(($process_item->activity_user_id == Auth::user()->id || ($process_item->activity_organization ==Auth::user()->organization_id && Auth::user()->role_id == 4)) && $process_item->status_id != 8)
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
            @endif
        </div>
        <div class="row p-4 bg-white">
            <h6>Progress</h6>
            <hr>
        </div>
        <div class="row p-4 bg-white">
            <div class="col border border-muted rounded-lg mr-2 p-4">
                <h6> Current Progress</h6>
                @if (count($Process_item_progresses) > 0)
                    <table class="table table-light table-striped border-secondary rounded-lg mr-4">
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
                @endif
                @if(count($Process_item_progresses) < 1)
                <p>No progress yet</p>
                @endif
            </div>
            @if(($process_item->activity_user_id == Auth::user()->id || ($process_item->activity_organization ==Auth::user()->organization_id && Auth::user()->role_id == 4)) && $process_item->status_id != 8)
                <div class="col border border-muted rounded-lg mr-2 p-4">
                    <h6>Change assigned staff member</h6>
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
                                <td><a href="/approval-item/confirmassign/{{$user->id}}/{{$process_item->id}}" class="text-muted" onclick="return staffReAssign();">assign</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
        <div class="row p-4 bg-white">
        @if(($process_item->activity_user_id == Auth::user()->id || ($process_item->activity_organization ==Auth::user()->organization_id && Auth::user()->role_id == 4)) && $process_item->status_id != 8)
                <div class="col border border-muted rounded-lg mr-2 p-4">
                    <h6>Save investigation Progress</h6>
                    <br>
                    <form action="\approval-item\progresssave" method="post">
                        @csrf
                        <h6>Remark</h6>
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
                <div class="col border border-muted rounded-lg mr-2 p-4">
                    <h6>Final Decision</h6>
                    <br>
                    <form action="\approval-item\finalapproval" method="post">
                        @csrf
                        <h6>Remark</h6>
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
                            <button type="submit" class="btn btn-primary" onclick="return finaldecision();">Update</button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
        @if($process_item->form_type_id ==5)
            <div class="container">
                <div class="row p-4 bg-white">
                    <button type="submit" class="btn btn-primary" ><a href="/approval-item/investigate/{{$process_item->prerequisite_id}}" class="text-dark">Back to {{$process_item->prerequisite_process->form_type->type}}</a></button>
                </div>
            </div>
        @endif
</div>
<script>
    function prereqCancel() {
      if(!confirm("Please confim that you want to cancel this prerequisite. (the requestor of this prerequisite will be notified when cancelling)"))
      event.preventDefault();
    }
    function staffReAssign() {
      if(!confirm("Please confim that you want to change the staff member assigned to this application."))
      event.preventDefault();
    }
    function finaldecision() {
      if(!confirm("Please confim that you want to make the final decision on this application."))
      event.preventDefault();
    }
</script>
@endsection