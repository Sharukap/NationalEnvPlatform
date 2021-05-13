@extends('home')

@section('cont')
<h2 class="p-3" style="display:inline">User Management</h2>


<div class="container mt-4 bg-white border">

  <nav class="navbar navbar-expand-sm navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item {{ Route::currentRouteName() == 'userIndex' ? 'active' : '' }}">
        <a class="nav-link h4" href="{{ route('userIndex') }}">Users</a>
      </li>
      <li class="nav-item {{ Route::currentRouteName() == 'orgIndex' ? 'active' : '' }}">
        <a class="nav-link h4" href="{{ route('orgIndex') }}">Organizations</a>
      </li>
      @if(Auth::user()->role_id < 3)
      <li class="nav-item {{ Route::currentRouteName() == 'roleIndex' ? 'active' : '' }}">
        <a class="nav-link h4" href="{{ route('roleIndex') }}">Roles</a>
      </li>
      @endif
      @if (Auth::user()->role_id < 3)
        <li class="nav-item {{ Route::currentRouteName() == 'orgActIndex' ? 'active' : '' }}">
          <a class="nav-link h4" href="{{ route('orgActIndex') }}">Organization Form Handling</a>
        </li>
      @endif
    </ul>
  </nav>
  <div class="col-md">
    @yield('admin')
  </div>
</div>

@endsection