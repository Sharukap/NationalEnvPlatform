@extends('home')

@section('cont')
<div class="container mt-4 bg-white border">

  <nav class="navbar navbar-expand-sm navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item {{ Route::currentRouteName() == 'accessindex' ? 'active' : '' }}">
        <a class="nav-link h4" href="{{ route('accessindex') }}">Access</a>
      </li>
      <br>
      <li class="nav-item {{ Route::currentRouteName() == 'activityindex' ? 'active' : '' }}">
        <a class="nav-link h4" href="{{ route('activityindex') }}">Activity</a>
      </li>
      <br>
      <li class="nav-item {{ Route::currentRouteName() == 'crimetypeindex' ? 'active' : '' }}">
        <a class="nav-link h4" href="{{ route('crimetypeindex') }}">Crime Types</a>
      </li>
      <br>
      <li class="nav-item {{ Route::currentRouteName() == 'orgtypeindex' ? 'active' : '' }}">
        <a class="nav-link h4" href="{{ route('orgtypeindex') }}">Organization Types</a>
      </li>
      <br>
      <li class="nav-item {{ Route::currentRouteName() == 'ecotypeindex' ? 'active' : '' }}">
        <a class="nav-link h4" href="{{ route('ecotypeindex') }}">Eco System Types</a>
      </li>
      <br>
      <li class="nav-item {{ Route::currentRouteName() == 'gazetteindex' ? 'active' : '' }}">
        <a class="nav-link h4" href="{{ route('gazetteindex') }}">Gazettes</a>
      </li>
    </ul>
  </nav>
<div class="flex row border-secondary rounded-lg ml-3 justify-content-between">
    <!-- Sessions to display success or failure -->
    <span>
        <h3 class="text-center bg-success text-light">{{session('success')}}</h3>
    </span>
  
    <span>
        <!-- opens the create view -->
        <a href="/system-data/gazettescreate" class="btn btn-info mr-4" role="button">Create</a>
    </span>
    <table class="table table-light table-striped border-secondary rounded-lg mt-2 mr-4">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Gazette Number</th>
            <th scope="col">More Details</th>
            <th scope="col">Edit</th>
             <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($gazette as $gazette)
            <tr>
                <td>{{$gazette->id}}</td>
                <td>{{$gazette->gazette_number}}</td>
                <td><a href="/system-data/gazzettesview/{{$gazette->id}}" class="btn btn-outline-info mr-4" role="button">...</a></td>
                <td><a href="/system-data/gazzettesedit/{{$gazette->id}}"class="btn btn-outline-warning" role="button">Edit</a></td>
                <td><button class="btn btn-outline-danger" onclick="event.preventDefault();
                            document.getElementById('form-delete-{{$gazette->id}}').submit()">Delete</button>

                    <form id="{{'form-delete-'.$gazette->id}}" style="display:none" method="post" action="/system-data/gazzettesdelete/{{$gazette->id}}">
                        @csrf
                        @method('delete');
                    </form></td>
                <!-- If the organization isnt null display the name of the organization else display unassigned -->            
            </tr>
           @endforeach
        </tbody>
    </table>
</div>
@endsection