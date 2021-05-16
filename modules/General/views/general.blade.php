@extends('home')

@section('cont')
<span>
    <h4 class="text-center bg-success text-light">{{session('message')}}</h4>
</span>
<span>
    <h4 class="text-center bg-danger text-light">{{session('warning')}}</h4>
</span>
<h2 class="p-3" style="display:inline">General Module</h2>
<nav class="navbar navbar-expand-lg navbar-light justify-content-around">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="nav nav-tabs">
            @if(Auth()->user()->role_id != 6)
            <li class="nav-item ">
                <a class="nav-link h4 mr-4 text-dark {{ Route::currentRouteName() == 'pending' ? 'active' : '' }}" href="{{ route('pending') }}">Pending Request<span class="sr-only">(current)</span></a>
            </li>
            @endif
            <li class="nav-item ">
                <a class="nav-link h4 mr-4 text-dark {{ Route::currentRouteName() == 'treeremoval' ? 'active' : '' }}" href="{{ route('treeremoval') }}">Tree Removal</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link h4 mr-4 text-dark {{ Route::currentRouteName() == 'devproject' ? 'active' : '' }}" href="{{ route('devproject') }}">Development Project</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link h4 mr-4 text-dark {{ Route::currentRouteName() == 'envrestoration' ? 'active' : '' }}" href="{{ route('envrestoration') }}">Environment Restoration</a>
            </li>
            <!-- <li class="nav-item {{ Route::currentRouteName() == 'land' ? 'active' : '' }}">
                <a class="nav-link h4" href="{{ route('land') }}">Register Land</a>
            </li> -->
            <li class="nav-item ">
                <a class="nav-link h4 text-dark {{ Route::currentRouteName() == 'crime' ? 'active' : '' }}" href="{{ route('crime') }}">Environmental Complaints</a>
            </li>
        </ul>
    </div>
</nav>
<div class="col-md">
    @yield('general')
</div>

@endsection