@extends('home')

@section('cont')
<kbd><a href="/system-data/gazetteindex" class="text-white font-weight-bolder"><i class="fas fa-chevron-left"></i></i> BACK</a></kbd>  
<div class="container">
   <h2 style="text-align:center;" class="text-dark">Create Gazette</h2>
   <hr>
   <div class="row justify-content-md-center border p-4 bg-white">
      <div class="col-6 ml-3">
         <h6 style="text-align:left;" class="text-dark">Gazette Details</h6>
         <hr>
        <form method="post" action="/system-data/gazettessave">
            @csrf
         
            <div class="input-group mb-3">
               <div class="input-group-prepend">
                  <span class="input-group-text">Title </span>
               </div>
               <input type="text" class="form-control" name="title" placeholder="Enter Title">
            </div>
            @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <!-- Description. -->
            <div class="input-group mb-3">
               <div class="input-group-prepend">
                  <span class="input-group-text">Gazette Number</span>
               </div>
               <input type="text" class="form-control" name="gazettenumber" placeholder="Enter here">
            </div>
            @error('gazettenumber')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="input-group mb-3">
               <div class="input-group-prepend">
                  <span class="input-group-text">Gazette Date</span>
               </div>
               <input type="date" class="form-control" name="gazetteddate" placeholder="Enter here">
            </div>
            @error('gazettedate')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="input-group mb-3">
               <div class="input-group-prepend">
                  <span class="input-group-text">Degazetted Date</span>
               </div>
               <input type="date" class="form-control" name="degazetteddate" placeholder="Enter here">
            </div>
            @error('degazetteddate')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <br>
            <h6>Organizations</h6>
            <hr>
            <div class="input-group mb-3">
               <input type="text" class="form-control" id="org_1"name="organizations[]" placeholder="Organization 1,Organization 2">
               
            </div>
            @error('organizations')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
             <div class="input-group mb-3">
               <div class="input-group-prepend">
                  <span class="input-group-text">Content</span>
               </div>
               <input type="textarea" class="form-control" name="content" placeholder="Enter here">
            </div>
            @error('content')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            
             <input type="hidden" class="form-control" name="created_by_user_id" value="{{Auth::user()->id}}"/>
              <div style="float:right;">
               <button type="submit" name="status" value="1" class="btn btn-primary">Create</button>
               </form>
            </div>
           </div>
           </div>
           </div>
           
         @endsection