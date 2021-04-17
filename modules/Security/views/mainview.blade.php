@extends('home')

@section('cont')
<div class="row p-4 bg-white">
    <div class="col border border-muted rounded-lg mr-2 p-4">
                <table class="table table-light table-striped border-secondary rounded-lg mr-4">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Date Application logged</th>
                            @if($process_item->activity_organization ==null)
                                <th>Organization Assigned (Non registered)</th>
                            @else
                                <th>Organization Assigned</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$process_item->form_type->type}}</td>
                            <td>{{date('d-m-Y',strtotime($process_item->created_at))}}</td>
                            @if($process_item->activity_organization ==null)
                                <td>{{$process_item->ext_requestor}}</td>
                            @else
                                <td>{{$process_item->Activity_organization->title}}</td>
                            @endif
                        </tr>
                    </tbody>
                </table>
    </div>
</div>
<div class="row p-4 bg-white">
    <div class="col border border-muted rounded-lg mr-2 p-4">
        <h6>Audit records for the application</h6>
        @if($Audits == null)
            <h1>No data</h1>
        @else
            <table class="table table-light table-striped border-secondary rounded-lg mr-4">
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Organization</th>
                        <th>Action</th>
                        <th>View more details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Audits as $audit)
                        <tr>
                            <td>{{ $audit['user']->name }}</td>
                            <td>{{ $audit['user']->Organization->title }}</td>
                            <td>{{ $audit['event'] }}</td>
                            <td><a href="/security/individual/{{ $audit['id'] }}/{{$process_item->id}}" class="text-muted">More</a></td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>      
</div>

@endsection