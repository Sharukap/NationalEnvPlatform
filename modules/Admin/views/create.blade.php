@extends('home')

@section('cont')

<kbd><a href="/user/index" class="text-white font-weight-bolder"><i class="fas fa-chevron-left"></i></i> BACK</a></kbd>
<div class="container">
    <h2 style="text-align:center;" class="text-dark">Create User</h2>
    <hr>
    <div class="row justify-content-md-center border p-4 bg-white">
        <div class="col-6 ml-3">
            <form method="post" action="/user/store">
                @csrf
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Name</span>
                    </div>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Enter Name">
                </div>
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="input-group mb-3">
                <input type="text" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Enter email" name="email" />
                    <div class="input-group-append">
                        <span class="input-group-text">@example.com</span>
                    </div>
                </div>
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                @if(Auth::user()->role_id == 1 ||Auth::user()->role_id == 2)
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Organization</span>
                    </div>
                    <select name="organization" class="custom-select @error('organization') is-invalid @enderror">
                        <option selected value="">Select</option>
                        @foreach($organizations as $organization)
                        <option value="{{$organization->id}}" {{ Request::old()?(Request::old('organization')==$organization->id?'selected="selected"':''):'' }}>{{$organization->title}}</option>
                        @endforeach
                    </select>
                </div>
                @error('organization')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @endif

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Designation</span>
                    </div>
                    <select name="designation" class="custom-select @error('designation') is-invalid @enderror">
                        <option selected value="">Select</option>
                        @foreach($designations as $designation)
                        <option value="{{$designation->id}}" {{ Request::old()?(Request::old('designation')==$designation->id?'selected="selected"':''):'' }}>{{$designation->designation}}</option>
                        @endforeach
                    </select>
                </div>
                @error('designation')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Role</span>
                    </div>
                    <select name="role" class="custom-select @error('role') is-invalid @enderror">
                        <option selected value="">Select</option>
                        @foreach($roles as $role)
                        <option value="{{$role->id}}" {{ Request::old()?(Request::old('role')==$role->id?'selected="selected"':''):'' }}>{{$role->title}}</option>
                        @endforeach
                    </select>
                </div>
                @error('role')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <!-- If the user is not super admin then pass in the user's organization id as well -->
                @if (Auth::user()->role_id == 3 ||Auth::user()->role_id == 4)
                <input type="hidden" class="form-control" name="organization" value="{{Auth::user()->organization_id}}">
                @endif

                <input type="hidden" class="form-control" name="created_by" value="{{Auth::user()->id}}">

                <div style="float:right;">

                    <!-- Status value of 1 will be sent to activate the user as soon as s/he is created by admin/HoO or Manager -->
                    <button type="submit" name="status" value="1" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection