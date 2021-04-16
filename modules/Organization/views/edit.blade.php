@extends('home')

@section('cont')

<kbd><a href="/organization/index" class="text-white font-weight-bolder"><i class="fas fa-chevron-left"></i></i> BACK</a></kbd>
<div class="container">
    <h2 style="text-align:center;" class="text-dark">Edit&nbsp;{{$organization->title}}</h2>
    <hr>
    <div class="row justify-content-md-center border p-4 bg-white">
        <div class="col-6 ml-3">
            <form method="post" action="/organization/update/{{$organization->id}}">

                <h6 style="text-align:left;" class="text-dark">Organization Details</h6>
                @csrf
                @method('patch')
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Title</span>
                    </div>
                    <!-- Fill in the input fields with the current values of the organization -->
                    <input type="text" class="form-control" name="title" value="{{$organization->title}}">
                </div>
                @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror  
                           
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">City</span>
                    </div>
                    <input type="text" class="form-control" name="city" value="{{$organization->city}}">
                </div>
                @error('city')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Country</span>
                    </div>
                    <input type="text" class="form-control" name="country" value="{{$organization->country}}"disabled>
                </div>
                @error('country')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Type</span>
                    </div>
                    <select name="organization_type" class="custom-select" required>
                        @if($organization->type->title == NULL)
                        <option selected value="NULL">Select Organization</option>
                        @else
                        <option selected value="{{$organization->type->id}}">{{$organization->type->title}}</option>
                        @endif
                        @foreach($org_type as $org)
                        <option value="{{$org->id}}">{{$org->title}}</option>
                        @endforeach
                    </select>
                </div>
              
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Description</span>
                    </div>
                    <input type="text" class="form-control" name="description" value="{{$organization->description}}">
                </div>
                @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <br>
                  
                <div style="float:right;">
                    <button type="submit" name="status" value="1" class="btn btn-warning">Submit</button>
                </div>  
                </form>   
                <br>
                <br>
                <h6 style="text-align:left;" class="text-dark">Contact Details</h6>
                <br>
                <br>
                <table class="table table-light table-striped border-secondary rounded-lg mr-4">
                    <thead>
                        <tr>
                        <th scope="col">Type</th>
                        <th scope="col">Signature</th>
                    </thead>
                    <tbody>
                        @foreach ($contact as $key => $value)
                        <tr>
                            <td><input type="text" class="form-control" name="type" value="{{$value->type}}"></td>
                            <td><input type="text" class="form-control" name="contact_signature" value="{{$value->contact_signature}}"></td>
                           <td><input class="form-check-input" type="hidden" name='primary' id='1'  value=1 checked/></td>
                             <td><a href="/organization/contactremove/{{$value->id}}" class="btn btn-outline-warning" role="button">Remove</a></td>
                        </tr>
                        @endforeach
                         </tbody>
                </table>
                <br>
                  <form method="post" action="/organization/contactupdate/{{$organization->id}}">
                   @csrf
                <div class="form-check border-secondary rounded-lg mb-4" style="background-color:#ebeef0">
                    <label class="mt-2"> Add new Contact: </label>
                    <hr>
                     <div class="container" id="addnew">
               <div class="row">
                  <div class="col-sm-4">
                     <select name="type[0]" class="custom-select">
                        <option selected>Mobile Number</option>
                        <option>Land Number</option>
                        <option>Email</option>
                        <option>Fax</option>
                        <option>Address</option>
                     </select>
                     @error('type')
                     <div class="alert alert-danger">{{ $message }}</div>
                     @enderror
                  </div>
                  <div class="col-sm-6 pl-0 pr-0 ml-0 mr-0">
                     <input type='text' class="form-control" name='contact_signature[0]' id='contact_signature' placeholder="Type here"/>
                  </div>
                  <div class="col-sm pl-4 pr-0 ml-0 mr-0 form-check">
                     <input class="form-check-input" type="checkbox" name='primary' id='1'  value=1 />&nbsp<label for='primary'>Primary</label>
                  </div>
               </div>
               </div>
                    </div>
                     <br>
            
            <input type="button" class="btn btn-outline-secondary btn-sm" id="add" value="Add"> <input type="button" id="remove" value="Remove" class="btn btn-outline-secondary btn-sm"/>
            <br>
            <br>
                <div style="float:right;">
                    <button type="submit" name="status" value ="1" class="btn btn-warning">Add</button>
                </div>
            </form>
            <script>  
            var signatureInputCount=1;
            var typeInputCount=1;
            
               $(document).ready(function() 
            {  
                   $("#add").on("click", function() 
            {           
                        
                        $("<div class='row' id='typeboxDiv0'>").appendTo("#addnew");
                        $("<div class='col-sm-4' id='1st'>").appendTo("#typeboxDiv0");
                        $("<select class='custom-select'>").attr("name", `type[${typeInputCount++}]`).appendTo("#1st").append(
                        $("<option>").val("mobile").text("Mobile Number"),
                        $("</option><option>").val("land").text("Land Number"),
                        $("</option><option>").val("email").text("Email"),
                        $("</option><option>").val("fax").text("Fax"),
                        $("</option><option>").val("address").text("Address"));
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
               });  
         </script>  
            <br>
            <br>
            <hr>
            <br>
            <h6 style="text-align:left;" class="text-dark">Current activities of The Organization: </h6>
            <hr>
            <table>
                    @foreach ($ORG_ACT as $key => $value)
                            
                             <tr>
                            <td>{{$value->activity->activity}}</td>
                            <td> {{$value->province->province}}</td>
                            <td>  </td>
                            <td><a href="/organization/removeActivity/{{$value->activity->id}}" class="btn btn-outline-warning" role="button">Remove</a></td>
                        </td>
                        </tr>
                    @endforeach
            </table>
            <br>
            <form method="post" action="/organization/addactivity/{{$organization->id}}">
                @csrf
                <div class="form-check border-secondary rounded-lg mb-4" style="background-color:#ebeef0">
                    <label class="mt-2"> Add new activity: </label>
                    <hr>
                    <fieldset>
                    @foreach($Activities as $activity)
                        <input type="checkbox" name="modules[]" value="{{$activity->id}}"><label class="ml-2">{{$activity->activity}}</label> <br>
                    @endforeach
                    </fieldset>
                </div> 
                <div class="input-group mb-3">
               <div class="input-group-prepend">
                  <span class="input-group-text">Province</span>
               </diV>
               <select name="province" class="custom-select" >
                  <option disabled selected>Select Province</option>   
                  @foreach ($province as $province)
                  <option value="{{ $province->id }}">{{ $province-> province}}</option>
                  @endforeach
               </select>
            </div>
            @error('province')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
                <div style="float:right;">
                    <button type="submit" class="btn btn-warning">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection