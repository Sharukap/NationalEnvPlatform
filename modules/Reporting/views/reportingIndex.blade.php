@extends('home')

@section('cont')
<h2 class="p-3" style="display:inline">Reporting Module</h2>
<nav class="navbar navbar-expand-lg navbar-light justify-content-around">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link h4 mr-4 text-dark {{ Route::currentRouteName() == 'reportingOverview' ? 'active' : '' }}" href="{{ route('reportingOverview') }}">Overview<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link h4 mr-4 text-dark {{ Route::currentRouteName() == 'reportingTreeRemoval' ? 'active' : '' }}" href="{{ route('reportingTreeRemoval') }}">Tree Removal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link h4 mr-4 text-dark {{ Route::currentRouteName() == 'reportingDevProj' ? 'active' : '' }}" href="{{ route('reportingDevProj') }}">Development Project</a>
            </li>
            <li class="nav-item">
                <a class="nav-link h4 mr-4 text-dark {{ Route::currentRouteName() == 'reportingRestoration' ? 'active' : '' }}" href="{{ route('reportingRestoration') }}">Restoration</a>
            </li>
            <li class="nav-item">
                <a class="nav-link h4 text-dark {{ Route::currentRouteName() == 'reportingComplaints' ? 'active' : '' }}" href="{{ route('reportingComplaints') }}">Complaints</a>
            </li>
        </ul>
    </div>
</nav>
<div class="col-md">
    @yield('reporting')
</div>
<!--chart js -->
<script src="{{ url('/vendor/chart.js/dist/Chart.min.js') }}"></script>
<script src="{{ url('/vendor/chart.js/dist/Chart.extension.js') }}"></script>
<script src="{{ url('/vendor/create-charts.js' ) }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.js" integrity="sha512-UNbeFrHORGTzMn3HTt00fvdojBYHLPxJbLChmtoyDwB6P9hX5mah3kMKm0HHNx/EvSPJt14b+SlD8xhuZ4w9Lg==" crossorigin="anonymous"></script>
@endsection