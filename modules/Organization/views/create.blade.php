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
               <input type="text" class="form-control" name="title" placeholder="Enter name"required>
            </div>
            @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
              <!-- Select province. -->
            <div class="input-group mb-3">
               <div class="input-group-prepend">
                  <span class="input-group-text">Province</span>
               </diV>
               <select name="province" class="custom-select" >
                  <option disabled selected>Select Province</option>   
                  @foreach ($Provinces as $province)
                  <option value="{{ $province->id }}">{{ $province-> province}}</option>
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
               <input type="text" class="form-control" name="city" placeholder="Enter City" required >
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
                  <option disabled selected>Organization Type</option>   
                  @foreach ($org_type as $page)
                  <option value="{{ $page->id }}">{{ $page->title }}</option>
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
               <input type="text" class="form-control" name="description" placeholder="Enter Description" required>
            </div>
            @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <br>
            <br>
            <!--Contact Details. -->
            <h6 style="text-align:left;" class="text-dark">Contact Details</h6>
            <hr>
            <!-- Start Select Contact Type. -->
            <p> Select Contact type </p>
            <br>
            <div class="container" id="addnew">
               <div class="row">
                  <div class="col-sm-4">
                     <select name="type[]" class="custom-select">
                     <option >Mobile Number</option>
                     <option >Land Number</option>
                      <option >Email</option>
                      <option >Fax</option>
                      <option>Address</option>
                     </select>
                     @error('type')
                     <div class="alert alert-danger">{{ $message }}</div>
                     @enderror
                  </div>
                  <div class="col-sm-6 pl-0 pr-0 ml-0 mr-0">
                     <input type='text' class="form-control" name='contact_signature[]' id='contact_signature' placeholder="Type here" required/>
                  </div>
                  <div class="col-sm pl-4 pr-0 ml-0 mr-0 form-check">
                     <input class="form-check-input" type="checkbox" name='primary' id='1'  value=1 required/>&nbsp<label for='primary'>Primary</label>
                  </div>
               </div>
               
               <!-- New input fields will appire here. -->
            </div>
            <!-- End Select Contact Type. -->
            <br>
            <input type="button" class="btn btn-outline-secondary btn-sm" id="add" value="Add"> <input type="button" id="remove" value="Remove" class="btn btn-outline-secondary btn-sm"/>
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
            <input type="hidden" class="form-control" name="created_by" value="{{Auth::user()->id}}"/>
            <br>
         <div style="float:right;">
               <button type="submit" name="status" value="1" class="btn btn-primary">Create</button>
            </div>
             @if(count($errors))
            <div class="form-group">
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
         </form>
         <script>  
            var signatureInputCount=1;
            var typeInputCount=1;
            var ActivityCount=1;
            
               $(document).ready(function() 
            {  
                   $("#add").on("click", function() 
            {           
                        
                        $("<div class='row' id='typeboxDiv0'>").appendTo("#addnew");
                        $("<div class='col-sm-4' id='1st'>").appendTo("#typeboxDiv0");
                        $("<select class='custom-select'>").attr("name", `type[${typeInputCount++}]`).appendTo("#1st").append(
                        $("<option>").val("Mobile Number").text("Mobile Number"),
                        $("</option><option>").val("Land Number").text("Land Number"),
                        $("</option><option>").val("Email").text("Email"),
                        $("</option><option>").val("Fax").text("Fax"),
                        $("</option><option>").val("Address").text("Address"));
                        $("#1st").append("</option></select>");  
                        $("#1st").append("</div>");    
            
                      $("<div class='col-sm-6 pl-0 pr-0 ml-0 mr-0' id='2nd'>").appendTo("#typeboxDiv0");
                       $("#2nd").append(`<input type='text' class='form-control' name='contact_signature[${signatureInputCount++}]' id='value' placeholder='Type here'/>`); 
                        $("#2nd").append("</div>"); 

                        $("<div class='col-sm pl-4 pr-0 ml-0 mr-0 form-check' id='3rd'>").appendTo("#typeboxDiv0");
                        $("#3rd").append(`<input type='checkbox' class ='form-check-input' name='primary' id='1' value='1'/>`); 
                        $("#3rd").append(`<label for='primary'>Primary</label>`); 
                        $("#3rd").append("<div>");
                        $("#typeboxDiv0").append("<div>");
                        $("#addnew").append("<div>");

                           
                       
            });
            
            $("#remove").on("click", function() 
            {  
            
                       $("#3rd").children().last().remove(); 
                        $("#3rd").children().last().remove(); 
                         $("#3rd").children().last().remove();  
                      $("#2nd").children().last().remove();  
                       $("#1st").children().last().remove();  
                    
                      
                                            
            });  
               $("#add2").on("click", function() 
            {    
                
                 $("<div class='row' id='typebox'>").appendTo("#addactivity");
                 $("<div class='col-sm-12 pl-3 pr-3 ml-0 mr-0' id='4th'>").appendTo("#typebox");
                 $("#4th").append(`<select class='custom-select' name='activity[${ActivityCount++}]' id='value'/>`).appendTo("#4th");
                $("#4th").append("</div>"); 

       

            });
             $("#remove2").on("click", function() 
            {       
                       $("#4th").children().last().remove();  
                      
            
                       });  

               });
               
                    </script>  
                   
      </div>
   </div>
</div>
@endsection
