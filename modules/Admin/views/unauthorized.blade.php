@extends('home')

<!-- If the user is not activated then this view saying you are not an activated user will be displayed -->

@section('cont')
@if(!empty($Msg))
<h5 class="alert alert-danger"> {{ $Msg }}</h5>
@endif
@endsection