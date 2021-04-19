@extends('home')

@section('cont')
 <kbd><a href="/sytem-data/crimetypeindex" class="text-white font-weight-bolder"><i class="fas fa-chevron-left"></i></i> BACK</a></kbd>   
<div class="container">
   <h2 style="text-align:center;" class="text-dark">Crime Types</h2>
   <hr>
   <div class="row justify-content-md-center border p-4 bg-white">
      
        <form method="post" action="/sytem-data/crimetypessave">
            @csrf
           
            <div class="input-group mb-3">
               <div class="input-group-prepend">
                  <span class="input-group-text">Type</span>
               </div>
               <input type="text" class="form-control" name="type" placeholder="Enter Crime Type">
            </div>
            @error('type')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
           
              <div style="float:right;">
               <button type="submit" class="btn btn-primary">Create</button>
            </div>
           </div>
           </div>
           
           
         @endsection