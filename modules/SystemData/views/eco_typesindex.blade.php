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
        <a href="/sytem-data/eco_typescreate" class="btn btn-info mr-4" role="button">Create</a>
    </span>
    <table class="table table-light table-striped border-secondary rounded-lg mt-2 mr-4">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Type</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($env_type as  $env_type)
            <tr>
                <td>{{$env_type->id}}</td>
                <td>{{$env_type->type}}</td>
                <td><a href="/sytem-data/eco_typesedit/{{$env_type->id}}"class="btn btn-outline-warning" role="button">Edit</a></td>
                <td><button class="btn btn-outline-danger" onclick="event.preventDefault();
                            document.getElementById('form-delete-{{$env_type->id}}').submit()">Delete</button>

                    <form id="{{'form-delete-'.$env_type->id}}" style="display:none" method="post" action="/sytem-data/eco_typesdelete/{{$env_type->id}}">
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