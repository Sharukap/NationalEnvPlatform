@extends('Envmain')

@section('env')


<div class="container">
  <br>
  <table class="table table-striped table-white">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Eco-System Type</th>
        <th scope="col">Description</th>
        <th scope="col">Status</th>
        <th scope="col">More</th>
        <th scope="col">Images</th>



      </tr>
    </thead>
    <tbody>

      @foreach ($ecosystems as $row)
      <tr>
        <td>{{$row->id}}</td>
        <td>{{$row->ecosystems_type->type}}</td>
        <td>{{$row->description}}</td>

        @switch($row->status)
        @case('0')
        <td>Inactive</td>
        @break;
        @case('1')
        <td>Active</td>
        @break;
        @endswitch

        <!-- opens the more view -->
        <td class="text-center"><a href="/environment/moreeco/{{$row->id}}" class="btn btn-outline-info mr-4" role="button">...</a></td>

        <td> <img src="{{ $row->images }}" width="100px" height="100px" alt=" No Images"></td>

      </tr>

      @endforeach



    </tbody>
  </table>









</div>

@endsection