<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
</head>
<body>
    @include('admin.header')
    @include('admin.sidebar')

    <!-- Sidebar Navigation end -->

    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">

                <center>

                    <h1 style="font-size: 40px; font-weight: bolder; color: white;">
                        Gallery
                    </h1>

                    <div class="row">

                    @foreach($gallary as $image) <!-- Mengganti $gallary dengan $image -->
                    <div class="col-md-4">
                        <!-- Memperbaiki tag img, properti src sudah benar -->
                        <img src="/gallary/{{ $image->image }}" style="height: 200px!important; width: 300px!important;" />

                        <a class="btn btn-danger" href="{{ url('delete_gallary', $image->id) }}">Delete Image</a>
                    </div>
                    @endforeach

                    </div>

                    <!-- Image upload form -->
                    <form action="{{ url('upload_gallary') }}" method="Post" enctype="multipart/form-data">
                        @csrf  <!-- CSRF protection -->

                        <div style="padding: 30px;">
                            <label style="color: white; font-weight:bold;">Upload Image</label>
                            <input type="file" name="image" required>
                            <input class="btn btn-primary" type="submit" value="Add Image">
                        </div>
                    </form>

                </center>
            </div>
        </div>
    </div>

    @include('admin.footer')
</body>
</html>
