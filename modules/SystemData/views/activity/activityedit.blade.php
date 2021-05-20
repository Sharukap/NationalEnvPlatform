@extends('home')

@section('cont')
<kbd><a href="/system-data/activityindex" class="text-white font-weight-bolder"><i class="fas fa-chevron-left"></i></i> BACK</a></kbd>
<div class="container">
    <h2 style="text-align:center;" class="text-dark">Edit&nbsp;{{$activity->activity}}</h2>
    <hr>
    <div class="row justify-content-md-center border p-4 bg-white">
        <div class="col-6 ml-3">
          
              <h6 style="text-align:left;" class="text-dark">Activity Details</h6>
 <form method="post" action="/system-data/activityupdate/{{$activity->id}}">
                 @csrf
                @method('patch')
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Activity</span>
                    </div>
                   
                    <input type="text" class="form-control" name="activity" value="{{$activity->activity}}">
                </div>
                @error('activity')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Description</span>
                    </div>
                   
                    <input type="text" class="form-control" name="description" value="{{$activity->description}}">
                </div>
                @error('activity')
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
