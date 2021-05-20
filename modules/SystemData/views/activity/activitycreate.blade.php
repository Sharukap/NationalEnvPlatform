@extends('home')

@section('cont')
  <kbd><a href="/system-data/activityindex" class="text-white font-weight-bolder"><i class="fas fa-chevron-left"></i></i> BACK</a></kbd>     
<div class="container">
   <h2 style="text-align:center;" class="text-dark">Create Activity</h2>
   <hr>
   <div class="row justify-content-md-center border p-4 bg-white">
      <div class="col-6 ml-3">
         <h6 style="text-align:left;" class="text-dark">Activity Details</h6>
         <hr>
        <form method="post" action="/system-data/activitysave">
            @csrf
            <!-- Activty. -->
            <div class="input-group mb-3">
               <div class="input-group-prepend">
                  <span class="input-group-text">Activity </span>
               </div>
               <input type="text" class="form-control" name="activity" placeholder="Enter Activity" required>
            </div>
            @error('activity')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <!-- Description. -->
            <div class="input-group mb-3">
               <div class="input-group-prepend">
                  <span class="input-group-text">Description</span>
               </div>
               <input type="textarea" class="form-control" name="description" placeholder="Enter Description" required>
            </div>
            @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
              <div style="float:right;">
               <button type="submit" name="status" value="1" class="btn btn-primary">Create</button>
            </div>
           </div>
           </div>
           </div>
           
         @endsection