@extends('admin.adminDashTemplate')
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Add Users</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{ route('admin.added') }}" method="POST">
        @csrf
      <div class="card-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" name="name"  placeholder="Enter name">
            <span>@error('name')
                {{ $message }}
            @enderror</span>
          </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
          <span>
              @error('email')
                  {{ $message }}
              @enderror
          </span>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
          <span>
            @error('password')
                {{ $message }}
            @enderror
        </span>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Confirm Password</label>
            <input type="password" name="c_password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            <span>
                @error('c_password')
                    {{ $message }}
                @enderror
            </span>
          </div>
          </div>
        </div>
        <div class="form-check">
            <input type="hidden" name="is_admin" value="2">
          <input type="checkbox" value="1" name="is_admin" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">IsAdmin</label>
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
@endsection
