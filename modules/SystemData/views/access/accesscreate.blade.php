@extends('home')

@section('cont')
  <kbd><a href="/system-data/accessindex" class="text-white font-weight-bolder"><i class="fas fa-chevron-left"></i></i> BACK</a></kbd>  
<div class="container">
   <h2 style="text-align:center;" class="text-dark">Add Access</h2>
   <hr>
   <div class="row justify-content-md-center border p-4 bg-white">
      <div class="col-3 ml-3">
         <h6 style="text-align:left;" class="text-dark">Access Details</h6>
         <hr>
        <form method="post" action="/system-data/accesssave">
            @csrf
            <!-- -->
            <div class="input-group mb-3">
               <div class="input-group-prepend">
                  <span class="input-group-text">Access </span>
               </div>
               <input type="text" class="form-control" name="access" placeholder="Enter">
            </div>
            @error('access')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
           
              <div style="float:right;">
               <button type="submit" name="status" value="7" class="btn btn-primary">Create</button>
               </form>
            </div>
           </div>
           </div>
           </div>
           
         @endsection