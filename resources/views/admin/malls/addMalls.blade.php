@extends('admin.adminDashTemplate')
@section('Head', 'Malls')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Add Mall</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <form action="{{ route('admin.addMallData') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter name">
                    <span>@error('name')
                            {{ $message }}
                        @enderror</span>
                </div>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" name="slug" placeholder="Enter slug name">
                    <span>@error('slug')
                            {{ $message }}
                        @enderror</span>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" placeholder="Enter address">
                    <span>@error('address')
                            {{ $message }}
                        @enderror</span>
                </div>
                <div class="form-group">
                    <label for="lat">Lat</label>
                    <input type="text" class="form-control" name="lat" placeholder="Enter Lat">
                    <span>@error('lat')
                            {{ $message }}
                        @enderror</span>
                </div>
                <div class="form-group">
                    <label for="long">Long</label>
                    <input type="text" class="form-control" name="long" placeholder="Enter Long">
                    <span>@error('lat')
                            {{ $message }}
                        @enderror</span>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" name="phone" placeholder="Enter Lat">
                    <span>@error('phone')
                            {{ $message }}
                        @enderror</span>
                </div>
                <div class="form-group">
                    <label for="whtssupphone">WhtssAppPhone</label>
                    <input type="text" class="form-control" name="whtssupphone" placeholder="Enter Lat">
                    <span>@error('whtssupphone')
                            {{ $message }}
                        @enderror</span>
                </div>
                <div class="form-check">
                    <input type="hidden" name="is_active" value="2">
                    <input type="checkbox" value="1" name="is_active" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">IsActive</label>
                </div>

                {{-- Adding Images --}}
                <div class="input-group">
                    <div class="custom-file">

                        <input type="file" value="" name="photo" id="insertName" accept="image/*" onchange="previewFile()"
                            class="custom-file-input">
                        <label class="custom-file-label" for="imageIn">Choose file</label>
                        <input type="hidden" value="" id="getvalue" name="imageName">
                    </div>
                    {{-- Viewing diffrent sizes of image --}}
                    <div class="input-group">
                        <img src="" id="image" onclick="imgDesktop()" style="display: none" height="150px" width="150px">
                        <img src="" id="image1" onclick="imgMobile()" style="display: none" height="200px" width="150px">
                        <img src="" id="image2" onclick="imgPort()" style="display: none" height="150px" width="300px">
                    </div>
                    <div class="input-group-append">

                    </div>
                </div>
                <div class="form-group">
                    <label>Feature Description</label>
                    <textarea class="form-control" name="featuredescription" rows="3" placeholder="Enter ..."></textarea>
                </div>

                <div class="form-group">
                    <label>Service Descrition</label>
                    <textarea class="form-control" name="servicedescription" rows="3" placeholder="Enter ..."></textarea>
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
        function previewFile() {
            var image = document.getElementById('image');
            var image1 = document.getElementById('image1');
            var image2 = document.getElementById('image2');
            document.getElementById('image').style = "display:block";
            document.getElementById('image1').style = "display:block";
            document.getElementById('image2').style = "display:block";
            var file = document.querySelector('input[type = file]').files[0];
            var reader = new FileReader();
            reader.onload = function() {
                image.src = reader.result;
                image1.src = reader.result;
                image2.src = reader.result;
            }
            if (file) {
                reader.readAsDataURL(file);
            } else {
                image.src = "";
            }
        }
        // Pass image as Desktop version
        function imgDesktop() {
            var image = document.getElementById('image');
            document.getElementById('image1').style = "display:none";
            document.getElementById('image2').style = "display:none";
            var insertValue = document.getElementById('getvalue');
            insertValue.value = "Desktop";
            console.log(insertValue);
        }
        // Pass image for mobile data
        function imgMobile() {
            var image = document.getElementById('image1');
            document.getElementById('image').style = "display:none";
            document.getElementById('image2').style = "display:none";
            var insertValue = document.getElementById('getvalue');
            insertValue.value = "Mobile";
            console.log(insertValue);
        }
        // Give Portrait image as input
        function imgPort() {
            var image = document.getElementById('image2');
            document.getElementById('image1').style = "display:none";
            document.getElementById('image').style = "display:none";
            var insertValue = document.getElementById('getvalue');
            insertValue.value = "Portrait";
            console.log(insertValue);
        }
    </script>
@endsection
