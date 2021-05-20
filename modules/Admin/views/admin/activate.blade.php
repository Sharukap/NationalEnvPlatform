@extends('home')

@section('cont')


<kbd><a href="{{ url()->previous() }}" class="text-white font-weight-bolder"><i class="fas fa-chevron-left"></i></i> BACK</a></kbd>
<div class="container">
    <h2 style="text-align:center;" class="text-dark">Activate {{$user->name}}</h2>
    <hr>
    <div class="row justify-content-md-center border p-4 bg-white">
        <div class="col-6 ml-3">
            <form method="post" action="/admin/activate/{{$user->id}}">
                @csrf
                @method('patch')

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">ID</span>
                    </div>
                    <input type="text" class="form-control" name="id" value="{{$user->id}}" readonly>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Name</span>
                    </div>
                    <input type="text" class="form-control" name="name" value="{{$user->name}}" readonly>
                </div>

                <!-- Set the role, organization and designation to activate the user -->

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Role</span>
                    </div>
                    <select name="role" class="custom-select" class="form-control @error('role') is-invalid @enderror" required>
                        <option selected value="">Select Role</option>
                        @foreach($roles as $role)
                        <option value="{{$role->id}}" {{ Request::old()?(Request::old('role')==$role->id?'selected="selected"':''):'' }}>{{$role->title}}</option>
                        @endforeach
                    </select>
                </div>
                @error('role')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Organization</span>
                    </div>
                    <select name="organization" class="custom-select" class="form-control @error('organization') is-invalid @enderror" required>
                        <option selected value="">Select Organization</option>
                        @foreach($organizations as $organization)
                        <option value="{{$organization->id}}" {{ Request::old()?(Request::old('organization')==$organization->id?'selected="selected"':''):'' }}>{{$organization->title}}</option>
                        @endforeach
                    </select>
                </div>
                @error('organization')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Designation</span>
                    </div>
                    <select name="designation" class="custom-select" class="form-control @error('designation') is-invalid @enderror" required>
                        <option selected value="">Select Designation</option>
                        @foreach($designations as $designation)
                        <option value="{{$designation->id}}" {{ Request::old()?(Request::old('designation')==$designation->id?'selected="selected"':''):'' }}>{{$designation->designation}}</option>
                        @endforeach
                    </select>
                </div>
                @error('designation')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror


                <div style="float:right;">
                    <button type="submit" name="status" value="1" class="btn btn-success">Activate</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection