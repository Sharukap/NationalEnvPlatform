@extends('home')

@section('cont')
<span>
  <h3 class="text-center bg-success text-light">{{session('message')}}</h3>
</span>
<span>
  <h3 class="text-center bg-danger text-light">{{session('danger')}}</h3>
</span>
<h2 class="p-3" style="display:inline">User Management</h2>

<div class="container mt-4 bg-white border">
  <nav class="navbar navbar-expand-sm navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item mr-4 {{ Route::currentRouteName() == 'userIndex' ? 'active' : '' }}">
        <a class="nav-link h4" href="{{ route('userIndex') }}">Users</a>
      </li>
      <li class="nav-item mr-4 {{ Route::currentRouteName() == 'orgIndex' ? 'active' : '' }}">
        <a class="nav-link h4" href="{{ route('orgIndex') }}">Organizations</a>
      </li>
      @if(Auth::user()->role_id < 3) <li class="nav-item mr-4 {{ Route::currentRouteName() == 'roleIndex' ? 'active' : '' }}">
        <a class="nav-link h4" href="{{ route('roleIndex') }}">Roles</a>
        </li>
        @endif
        @if (Auth::user()->role_id < 3) <li class="nav-item {{ Route::currentRouteName() == 'orgActIndex' ? 'active' : '' }}">
          <a class="nav-link h4" href="{{ route('orgActIndex') }}">Organization Form Handling</a>
          </li>
          @endif
    </ul>
  </nav>
  <div class="col-md">
    <hr>
    @yield('admin')
  </div>
</div>

@endsection