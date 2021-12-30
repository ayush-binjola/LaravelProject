@extends('admin.adminDashTemplate')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Add Brands</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('add.brands') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $values['id'] }}">
            <div class="card-body ">
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $values['name'] }}" placeholder="Enter name">
                    <span>@error('name')
                            {{ $message }}
                        @enderror</span>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Slug</label>
                    <input type="text" class="form-control" name="slug" value={{ $values['slug'] }} placeholder="Enter slug">
                    <span>@error('slug')
                            {{ $message }}
                        @enderror</span>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Details</label>
                    <i class="fas fa-plus" id="addButton" onclick="addNewDetails"></i>
                    <input type="text" class="form-control"  placeholder="Enter details">
                    <span>@error('details')
                            {{ $message }}
                        @enderror</span>
                </div>
                <div class="form-check">
                    <input type="hidden" name="isActive" value="2">
                    <input type="checkbox" value="1" name="isActive" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">isActive</label>
                </div>
            </div>
    </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </form>
    </div>
    <script>


    </script>
@endsection
