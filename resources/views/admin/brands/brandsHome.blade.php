@extends('admin.adminDashTemplate')
@section('content')

<table class="table table-striped">
    <thead>
        <tr><a href="{{ route('add.brandsView')}}"><button type="button" class="col-2 mb-5 btn btn-block bg-gradient-primary">Add Brands</button></a></tr>
      <tr>
        <th>Id</th>
          <th>Name</th>
          <th>Slug</th>
          <th>IsActive</th>
          <th>Details</th>
          <th>Edit</th>
          <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($values as $value )
      <tr>
        <td>{{$value->id}}</td>
        <td>{{$value->name}}</td>
        <td>{{$value->slug}}</td>
        <td>{{$value->isActive}}</td>
        <td>{{ $value->details }}</td>
        <td><a href="{{"/admin/editBrands/". $value->id }}"><i class="fas fa-edit"></i></a></td>
        <td><a href="{{"/admin/delete/". $value->id }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
          <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 s0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
        </svg></a>
        </td>
      </tr>
@endforeach
    </tbody>
  </table>


@endsection
