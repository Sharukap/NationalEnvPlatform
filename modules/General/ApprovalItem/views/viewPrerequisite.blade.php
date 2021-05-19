@extends('approvalItem::approval')
@section('theme')
<div class="container bg-white">
    <div class="row p-4 bg-white">
        @if($process_item->prerequisite == 0)
            <h4>Investigating {{$process_item->form_type->type}} application no {{$process_item->form_id}} logged on {{date('d-m-Y',strtotime($item->created_at))}}</h4>
        @elseif($process_item->prerequisite == 1)
            <h4>Investigation for additional investigation request for {{$process_item->form_type->type}} no {{$process_item->form_id}} logged on {{date('d-m-Y',strtotime($item->created_at))}} by {{$process_item->requesting_organization->title}}</h4>
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
        </div>
        <div class="row p-4 bg-white">
            <button type="submit" class="btn btn-primary" ><a href="/approval-item/investigate/{{$process_item->prerequisite_id}}" class="text-dark">Back to {{$process_item->prerequisite_process->form_type->type}}</a></button>
        </div>
</div>
@endsection