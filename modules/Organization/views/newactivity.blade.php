@extends('adminorg')

@section('admin')
<div class="container">
    <form action="\organization\activitycreate" method="post">
        @csrf
        <div class="container bg-white">
            <div class="row p-4 bg-white">
                <div class="col border border-muted rounded-lg mr-2 p-4">
                    <div class="form-group">
                        <label for="form_type">Form type:</label>
                        <select name="form_type" class="custom-select" required>
                            <option value="" selected>Select Form Type</option>
                            @foreach($Forms as $form)
                            <option value="{{ $form->id }}" {{ Request::old()?(Request::old('form_type')==$form->id?'selected="selected"':''):'' }}>{{$form->type}}</option>
                            @endforeach
                        </select>
                        @error('form_type')
                        <div class="alert alert-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="organization">Organization in charge</label>
                        <input type="text" class="form-control typeahead" placeholder="Search" name="organization" value="{{ old('organization') }}" required />
                        @error('organization')
                        <div class="alert alert-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="province">Province:</label>
                        <select class="custom-select @error('province') is-invalid @enderror" name="province" required>
                            <option disabled selected value="">Select</option>
                            @foreach ($provinces as $province)
                            <option value="{{ $province->id }}" {{ Request::old()?(Request::old('province')==$province->id?'selected="selected"':''):'' }}>{{ $province->province }}</option>
                            @endforeach
                        </select>
                        @error('province')
                        <div class="alert alert-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="district">District:</label>
                        <select class="custom-select @error('district') is-invalid @enderror" name="district" required>
                            <option selected value="27">All districts of the province</option>
                            @foreach ($districts as $district)
                            <option value="{{ $district->id }}" {{ Request::old()?(Request::old('district')==$district->id?'selected="selected"':''):'' }}>{{ $district->district }}</option>
                            @endforeach
                        </select>
                        @error('district')
                        <div class="alert alert-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-check" style="float:right;">
                        <input type="hidden" class="form-control" name="create_by" value="{{ Auth::user()->id }}">
                        <label class="form-check-label">
                            <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    //THIS USES THE AUTOMECOMPLETE FUNCTION IN TREE REMOVAL CONTROLLER
    var path = "{{route('organizationTH')}}";
    $('input.typeahead').typeahead({
        source: function(terms, process) {

            return $.get(path, {
                terms: terms
            }, function(data) {
                console.log(data);
                objects = [];
                data.map(i => {
                    objects.push(i.title)
                })
                console.log(objects);
                return process(objects);
            })
        },
    });
</script>
@endsection