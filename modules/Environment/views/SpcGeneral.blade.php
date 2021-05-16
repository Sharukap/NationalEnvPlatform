@extends('Envmain')

@section('env')


<div class="container">

@if(Auth::user()->role_id != 6)
  <div>
    <a href="/environment/updatedataspecies" class="btn bd-navbar text-light" role="button">Admin Mode</a>
  </div>
@endif

  <br>

  @if(count($errors) >0)
  <div class="alert alert-danger">
    <ul>
      @foreach($errors->all() as $error)
      <li>{{$error}}</li>
      @endforeach
    </ul>
  </div>
  @endif

  @if(\Session::has('success'))
  <div class="alert alert-success">
    <p>{{\Session::get('success') }} </p>

  </div>
  @endif

  <table class="table table-striped table-white">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Type</th>
        <th scope="col">Title</th>
        <th scope="col">Scientific Name</th>
        <th scope="col">Description</th>
        <th scope="col">Status</th>
        <th scope="col">More</th>
        <th scope="col">Images</th>



      </tr>
    </thead>
    <tbody>

      @foreach ($species as $row)
      <tr>
        <td>{{$row->id}}</td>
        <td>{{$row->type}}</td>
        <td>{{$row->title}}</td>
        <td>{{$row->scientefic_name}}</td>
        <td>{{$row->description}}</td>



        @switch($row->status_id)
        @case('0')
        <td>Inactive</td>
        @break;
        @case('1')
        <td>Active</td>
        @break;
        @endswitch


        
        <!-- opens the more view -->
        <td class="text-center"><a href="/environment/morespecies/{{$row->id}}" class="btn btn-outline-info mr-4" role="button">...</a>


        </td>
        <td> <img src="{{ asset('uploads/species/' . $row->images) }}" width="100px" height="100px" alt=" No Images"></td>
      </tr>

      @endforeach



    </tbody>
  </table>




</div>

@endsection