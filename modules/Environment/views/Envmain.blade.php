@extends('home')

@section('cont')
<h2 class="p-3" style="display:inline">Environment Module</h2>

<div class="container mt-4 bg-white border">
  <nav class="navbar navbar-expand-sm navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link h4" href="/environment/updatedata">Eco-System Management</a>
      </li>
      <li class="nav-item">
        <a class="nav-link h4" href="/environment/updatedataspecies">Species Management</a>
      </li>
    </ul>
  </nav>

  <div class="col-md">
    @yield('env')
  </div>
</div>

@endsection