@extends('home')

@section('cont')
<kbd><a href="/system-data/gazetteindex" class="text-white font-weight-bolder"><i class="fas fa-chevron-left"></i></i> BACK</a></kbd>
<div class="container">
    <h2 style="text-align:center;" class="text-dark">Edit&nbsp;{{$gazette->title}}</h2>
    <hr>
    <div class="row justify-content-md-center border p-4 bg-white">
        <div class="col-6 ml-3">
          
              <h6 style="text-align:left;" class="text-dark">Gazette Details</h6>
<form method="post" action="/system-data/gazzettesupdate/{{$gazette->id}}">
                 @csrf
                @method('patch')
                <div class="input-group mb-3">
               <div class="input-group-prepend">
                  <span class="input-group-text">Title </span>
               </div>
               <input type="text" class="form-control" name="title" value="{{$gazette->title}}">
            </div>
            @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <!-- Description. -->
            <div class="input-group mb-3">
               <div class="input-group-prepend">
                  <span class="input-group-text">Gazette Number</span>
               </div>
               <input type="text" class="form-control" name="gazettenumber" value="{{$gazette->gazette_number}}">
            </div>
            @error('gazettenumber')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="input-group mb-3">
               <div class="input-group-prepend">
                  <span class="input-group-text">Gazette Date</span>
               </div>
               <input type="date" class="form-control" name="gazetteddate"  value="{{$gazette->gazetted_date}}">
            </div>
            @error('gazettedate')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <br>
            <h6>Organizations</h6>
            <hr>
            <div class="input-group mb-3">
               <input type="text" class="form-control"name="organizations[]" value="{{implode('  ,  ' , $gazette->organizations)}}">
               <!--input type="text" class="form-control"name="organizations[1]" value="{{implode($gazette->organizations)}}"-->
               
            </div>
            @error('organizations')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
             <div class="input-group mb-3">
               <div class="input-group-prepend">
                  <span class="input-group-text">Content</span>
               </div>
               <input type="textarea" class="form-control" name="content" value="{{$gazette->content}}">
            </div>
            @error('content')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
             <input type="hidden" class="form-control" name="created_by_user_id" value="{{Auth::user()->id}}"/>
             <div style="float:right;">
                    <button type="submit" name="status" value="1"class="btn btn-warning">Submit</button>
                </div>
            </form>
            </div>
            </div>
            </div>
            @endsection
