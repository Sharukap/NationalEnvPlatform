@extends('home')

@section('cont')
<h2 class="p-3" style="display:inline">Environment Module</h2>

<div class="container mt-4 bg-white border">
  <nav class="navbar navbar-expand-sm navbar-light">
    <ul class="navbar-nav">
    @if(Auth::user()->role_id == 1)
      <li class="nav-item">
        <a class="nav-link h4" href="/environment/updatedata">Eco-System Management</a>
      </li>
      <li class="nav-item">
        <a class="nav-link h4" href="/environment/updatedataspecies">Species Management</a>
      </li>
    @else
      <li class="nav-item">
        <a class="nav-link h4" href="/environment/viewdata">Eco-System Management</a>
      </li>
      <li class="nav-item">
        <a class="nav-link h4" href="/environment/viewdataspecies">Species Management</a>
      </li>
    @endif
    </ul>
  </nav>

  <div class="col-md">
    @yield('env')
  </div>
</div>

@endsection