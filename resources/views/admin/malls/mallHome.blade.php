@extends('admin.adminDashTemplate')
@section('content')
<div class="card-body">
    <table>
        @if (session()->has("savedMall"));
        <div class="alert alert-success">
            <strong>Mall saved Success!</strong>
          </div>
        @endif
        <tr><a href="{{ route('admin.addMall')}}"><button type="button" class="col-2 mb-5 btn btn-block bg-gradient-primary">Add Mall</button></a></tr>
    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4"><a href="{{ route('exportEx') }}"><button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="example1" type="button"><span>Excel</span></button> </a> <button class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0" aria-controls="example1" type="button"><span>PDF</span></button> <button class="btn btn-secondary buttons-print" tabindex="0" aria-controls="example1" type="button"><span>Print</span></button> <div class="btn-group"><button class="btn btn-secondary buttons-collection dropdown-toggle buttons-colvis" tabindex="0" aria-controls="example1" type="button" aria-haspopup="true" aria-expanded="false"><span>Column visibility</span></button></div> </div></div><div class="col-sm-12 col-md-6"><div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example1"></label></div></div></div><div class="row"><div class="col-sm-12"><table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
        <thead>
            <tr>
              <th>Id</th>
                <th>Name</th>
                <th>Address</th>
                <th>lat</th>
                <th>Date</th>
                <th>Long</th>
                <th>Phone</th>
                <th>WhatsAppPhone</th>
                <th>featureDescription</th>
                <th>serviceDescription</th>
            </tr>
          </thead>
      <tbody>
        @foreach ($values as $value )
        <tr>
          <td>{{$value->name}}</td>
          <td>{{$value->address}}</td>
          <td>{{$value->lat}}</td>
          <td>{{$value->Long1}}</td>
          <td>{{$value->phone}}</td>
          <td>{{$value->whatsAppPhone}}</td>
          <td>{{$value->featureDescription}}</td>
          <td>{{$value->serviceDescription}}</td>
          <td><a href="{{"/admin/getMall/". $value->id }}"><i class="fas fa-edit"></i></a></td>
          <td><a href="{{"/admin/deleteMall/". $value->id }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
          </svg></a>

          </td>
        </tr>
@endforeach</tbody>
</table>

@endsection
