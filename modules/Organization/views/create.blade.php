@extends('home')
@section('cont')
<kbd><a href="/organization/index" class="text-white font-weight-bolder"><i class="fas fa-chevron-left"></i></i> BACK</a></kbd>
<div class="container">
   <h2 style="text-align:center;" class="text-dark">Create Organization</h2>
   <hr>
   <div class="row justify-content-md-center border p-4 bg-white">
      <div class="col-6 ml-3">
         <!--Organizaion Details -->
         <h6 style="text-align:left;" class="text-dark">Organization Details</h6>
         <hr>
         <form method="post" action="/organization/store">
            @csrf
            <!-- Title. -->
            <div class="input-group mb-3">
               <div class="input-group-prepend">
                  <span class="input-group-text">Organization Name</span>
               </div>
               <input type="text" class="form-control" name="title" placeholder="Enter name"required value="{{ old('title') }}">
            </div>
            @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <!-- Select province. -->
            <div class="input-group mb-3">
               <div class="input-group-prepend">
                  <span class="input-group-text">Province</span>
               </diV>
               <select name="province" class="custom-select" required>
                  <option value="" disabled selected>Select Province</option>
                  @foreach ($Provinces as $province)
                  <option value="{{ $province->id }}"{{ Request::old()?(Request::old('province')==$province->id?'selected="selected"':''):'' }}>{{ $province->province }}</option>
                  @endforeach
               </select>
            </div>
            @error('province')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <!-- City. -->
            <div class="input-group mb-3">
               <div class="input-group-prepend">
                  <span class="input-group-text">City</span>
               </div>
               <input type="text" class="form-control" name="city" placeholder="Enter City" required value="{{ old('city') }}">
            </div>
            @error('city')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <!-- Select Organization Type. -->
            <div class="input-group mb-3">
               <div class="input-group-prepend">
                  <span class="input-group-text">Type</span>
               </diV>
               <select name="organization_type" class="custom-select" required>
                  <option value="" disabled selected>Organization Type</option>
                  @foreach ($org_type as $page)
                  <option value="{{ $page->id }}"{{ Request::old()?(Request::old('organization_type')==$page->id?'selected="selected"':''):'' }}>{{ $page->title }}</option>
                  @endforeach
               </select>
            </div>
            @error('organization_type')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <!-- Description field. -->
            <div class="input-group mb-3">
               <div class="input-group-prepend">
                  <span class="input-group-text">Description</span>
               </div>
               <input type="text" class="form-control" name="description" placeholder="Enter Description" required  value="{{ old('description') }}">
            </div>
            @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            
            <!-- contact. -->
            <div class="input-group mb-3">
               <div class="input-group-prepend">
                  <span class="input-group-text">Address</span>
               </div>
               <input type="text" class="form-control" name="address" placeholder="Enter address" required  value="{{ old('address') }}">
            </div>
            @error('address')
               <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <br>
            <h6 style="text-align:left;" class="text-dark">Primary Contact</h6>
            <br>
            <div class="input-group mb-3">
               <div class="input-group-prepend">
                     <select name="type" class="custom-select" required>
                        <option disabled selected value >Contact Type</option>
                        <option value ="1" >Phone Number</option>
                        <option value ="2">Email</option>
                        <option value ="3">Fax</option>
                     </select>
                     
               </div>
               <input type="text" class="form-control" name="contact" placeholder="Enter contact" required  value="{{ old('contact') }}">
            </div>
            @error('type')
                     <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('contact')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <br>
            <br>
            <!-- Select Organization Activity. -->
            <h6 style="text-align:left;" class="text-dark">Activities</h6>
            <hr>
            <div>
               <fieldset>
                  @foreach ($Activities as $activity)
                  <input type="checkbox" name="activity[]" value="{{ $activity->id }}"><label class="ml-2" />{{ $activity->activity }}</label> <br>
                  @endforeach
               </fieldset>
            </div>
            <br>
            @error('activity')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <!--pass in the user's organization id as well -->
            <input type="hidden" class="form-control" name="created_by" value="{{Auth::user()->id}}" />
            <br>
            <div style="float:right;">
               <button type="submit" name="status" value="1" class="btn btn-primary">Create</button>
            </div>

            <br>
            <br>
         </form>
         <script>  

            var ActivityCount=1;
            
               $("#add2").on("click", function() 
            {    
                 $("<div class='row' id='typebox'>").appendTo("#addactivity");
                 $("<div class='col-sm-12 pl-3 pr-3 ml-0 mr-0' id='4th'>").appendTo("#typebox");
                 $("#4th").append(`<select class='custom-select' name='activity[${ActivityCount++}]' id='value'/>`).appendTo("#4th");
                $("#4th").append("</div>"); 
               });

               $("#remove").on("click", function() {

                  $("#3rd").children().last().remove();
                  $("#3rd").children().last().remove();
                  $("#3rd").children().last().remove();
                  $("#2nd").children().last().remove();
                  $("#1st").children().last().remove();



               });
               $("#add2").on("click", function() {

                  $("<div class='row' id='typebox'>").appendTo("#addactivity");
                  $("<div class='col-sm-12 pl-3 pr-3 ml-0 mr-0' id='4th'>").appendTo("#typebox");
                  $("#4th").append(`<select class='custom-select' name='activity[${ActivityCount++}]' id='value'/>`).appendTo("#4th");
                  $("#4th").append("</div>");



               });
               $("#remove2").on("click", function() {
                  $("#4th").children().last().remove();


               });

            });
         </script>

      </div>
   </div>
</div>
@endsection