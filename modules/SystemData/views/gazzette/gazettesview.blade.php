@extends('home')

@section('cont')

<kbd><a href="/system-data/gazetteindex" class="text-white font-weight-bolder"><i class="fas fa-chevron-left"></i></i> BACK</a></kbd>

<div class="container">
    <h2 style="text-align:center;" class="text-dark">Details of {{$gazette->title}}</h2><hr>
    <div class="row justify-content-md-center border p-4 bg-white">
        <div class="col-8">
            <form>
            <h6 style="text-align:left;" class="text-dark">Gazette Details</h6>
           <hr>
           
            
            <div class="row">
                <div class="col">
                <strong>Title :</strong>
                </div>
                <div class="col">
                {{ $gazette->title }}
                </div>
            </div>
              <div class="row">
                <div class="col">
                <strong>Gazette Number :</strong>
                </div>
                <div class="col">
                {{ $gazette->gazette_number }}
                </div>
            </div>
               <div class="row">
                <div class="col">
                <strong>Gazetted Date :</strong>
                </div>
                <div class="col">
                {{ $gazette->gazetted_date }}
                </div>
            </div>
               <div class="row">
                <div class="col">
                <strong>Degazetted Date :</strong>
                </div>
                <div class="col">
                {{ $gazette->degazetted_date }}
                </div>
            </div>
               <div class="row">
                <div class="col">
                <strong>Organizations :</strong>
                </div>
                <div class="col">
               {{implode(',',$gazette->organizations)}}
                </div>
            </div>
               <div class="row">
                <div class="col">
                <strong>Content :</strong>
                </div>
                <div class="col">
                {{ $gazette->content }}
                </div>
            </div>
             <div class="row">
                <div class="col">
                <strong>Created by:</strong>
                </div>
                <div class="col">
                <ul> <li> User Id:  {{Auth::user()->id}} </li> 
                <li> Name:   {{Auth::user()->name}} </li>
                 </ul>
                </div>
            </div>
            <br>

        </div>
    </div>
</div>

@endsection