@extends('home')

@section('cont')
<h2 class="p-3">Your Requests</h2>
<div class="row">
    <div class="col-7">
        <span>
            <h4 class="text-center bg-success text-light">{{session('message')}}</h4>
        </span>
        <span>
            <h4 class="text-center bg-danger text-light">{{session('warning')}}</h4>
        </span>
    </div>
    <div class="col">
        <!-- Filter Dropdown -->
        <div class="dropdown" style="float:right;">
            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-filter" aria-hidden="true"></i> Filter
                <span class="caret"></span></button>
            <ul class="dropdown-menu dropdown-menu-right">
                <form action="/approval-item/filterRequests" method="get">
                    <div class="container">
                        <li class="dropdown-header">Filter by Date</li>
                        <li><input class="date form-control" type="text" placeholder="Select Date" name="date"></li>
                        <li class="dropdown-header">Filter by Organization</li>
                        <li><select name="organization" class="custom-select">
                                <option selected disabled value="">Select Org.</option>
                                @foreach($organizations as $organization)
                                <option value="{{$organization->id}}">{{$organization->title}}</option>
                                @endforeach
                            </select></li>

                        <li class="dropdown-header"></li>
                        <li style="float:right;">
                            <button type="submit" class="btn bg-primary text-light">Apply</button>
                            <a class="btn btn-warning ml-1" href="/approval-item/showRequests"><i class="fa fa-retweet" aria-hidden="true"></i></a>
                        </li>
                    </div>
                </form>
            </ul>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <table class="table table-hover table-light mr-4">
            <thead>
                <tr>
                    <th>Process ID</th>
                    <th>Type</th>
                    <th>Date Created</th>
                    <th>Request Org.</th>
                    <th>Request From</th>
                    <th>Status</th>
                    <th>More Data</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->form_type->type}}</td>
                    <td>{{$item->created_at}}</td>

                    @if($item->request_organization)
                    <td>{{$item->requesting_organization->title}}</td>
                    @else
                    <td>{{$item->ext_requestor_email}}</td>
                    @endif

                    <td>{{$item->Activity_organization->title}}</td>


                    <td>{{$item->status->type}}</td>
                    @if($item->form_type_id == 1)
                    <td><a href="/tree-removal/show/{{$item->id}}" class="btn btn-info text-light">See full request</a></td>
                    @elseif($item->form_type_id == 2)
                    <td><a href="/dev-project/show/{{$item->id}}" class="btn btn-info text-light">See full request</a></td>
                    @elseif($item->form_type_id == 3)
                    <td><a href="/env-restoration/show/{{$item->id}}" class="btn btn-info text-light">See full request</a></td>
                    @elseif($item->form_type_id == 4)
                    <td><a href="/crime-report/viewcrime/{{$item->id}}" class="btn btn-info text-light">See full request</a></td>
                    @elseif($item->form_type_id == 5)
                    <td><a href="/land/show/{{$item->id}}" class="btn btn-info text-light">See full request</a></td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    $('.date').datepicker({
        format: 'yyyy-mm-dd'
    });
</script>
@endsection