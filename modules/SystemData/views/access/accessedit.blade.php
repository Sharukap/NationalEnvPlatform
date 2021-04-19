@extends('home')

@section('cont')
<kbd><a href="/system-data/accessindex" class="text-white font-weight-bolder"><i class="fas fa-chevron-left"></i></i> BACK</a></kbd>
<div class="container">
    <h2 style="text-align:center;" class="text-dark">Edit&nbsp;{{$access->access}}</h2>
    <hr>
    <div class="row justify-content-md-center border p-4 bg-white">
        <div class="col-6 ml-3">
          
              <h6 style="text-align:left;" class="text-dark">Access Details</h6>
 <form method="post" action="/system-data/accessupdate/{{$access->id}}">
                 @csrf
                @method('patch')
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Access</span>
                    </div>
                   
                    <input type="text" class="form-control" name="access" value="{{$access->access}}">
                </div>
                @error('access')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                
                <div style="float:right;">
                    <button type="submit" name="status" value="7"class="btn btn-warning">Submit</button>
                </div>
            </form>
            </div>
            </div>
            </div>
            
            @endsection
