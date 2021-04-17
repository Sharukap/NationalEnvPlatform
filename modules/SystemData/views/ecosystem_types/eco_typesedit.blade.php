@extends('home')

@section('cont')
<kbd><a href="/sytem-data/eco_typesindex" class="text-white font-weight-bolder"><i class="fas fa-chevron-left"></i></i> BACK</a></kbd>
<div class="container">
    <h2 style="text-align:center;" class="text-dark">Edit&nbsp;{{$env_type->type}}</h2>
    <hr>
    <div class="row justify-content-md-center border p-4 bg-white">
        <div class="col-6 ml-3">
         <form method="post" action="/sytem-data/eco_typesupdate/{{$env_type->id}}"> 
              <h6 style="text-align:left;" class="text-dark">Eco System Type Details</h6>

                 @csrf
                @method('patch')
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Type</span>
                    </div>
                   
                    <input type="text" class="form-control" name="type" value="{{$env_type->type}}">
                </div>
                @error('type')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                 <div style="float:right;">
                    <button type="submit" name="status" value="1"class="btn btn-warning">Submit</button>
                </div>
            </form>
            </div>
            </div>
            </div>
            @endsection
