@extends('layouts.template')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit User</h2>
        </div>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('users.update', $user->id) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <input type="hidden" name="id" value="{{ $user->id }}"> <br />
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Profile Image:</strong>
                <br>
                <div class="image-preview">
                    <img src="{{ Storage::url('images/' . $user->imagePath) }}" alt="Current Image"
                        style="max-width:200px; border-radius:50%;">
                </div>
                <br><br>
                <input type="file" class="form-control" name="imagePath" id="imagePath" onchange="previewImage()">
                <br>
                <div class="image-preview" id="testDiv">
                    <img id="preview" src="" alt="Preview Image" style="max-width:100px; border-radius:50%;">
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="fullName" value="{{ $user->fullName }}" class="form-control"
                    placeholder="Full Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                <input type="email" class="form-control" name="email" value="{{ $user->email }}" placeholder="Email">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Password:</strong>
                <input type="password" class="form-control" autocomplete="new-password" name="password"
                    placeholder="Password">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Date of Birth:</strong>
                <input type="date" name="dateBirth"
                    value="{{  \Carbon\Carbon::parse($user->dateBirth)->format('Y-m-d') }}" class="form-control"
                    placeholder="Date of Birth">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>ID Number:</strong>
                <input type="text" name="idNo" value="{{ $user->idNo }}" class="form-control" placeholder="ID Number">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Address:</strong>
                <textarea class="form-control" style="height:150px" name="address"
                    placeholder="Address">{{ $user->address }}</textarea>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
        </div>
    </div>

</form>
<style>
    .img-circle {
        border-radius: 50%;
    }

    .image-preview {
        position: relative;
        width: 100px;
        height: 100px;
        overflow: hidden;
        background-color: #f8f8f8;
        border-radius: 50%;
    }

    .image-preview img {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* for covering the container */
        /* object-fit: contain; for centering the image */
    }

    #preview,
    #testDiv {
        display: none;
    }
</style>
<script>
    function previewImage() {
        var preview = document.querySelector('#preview');
        var testDiv = document.querySelector('#testDiv');
        var file = document.querySelector('#imagePath').files[0];
        var reader = new FileReader();
    
        reader.addEventListener("load", function () {
            preview.style.display = 'block';
            testDiv.style.display = 'block';
            preview.src = reader.result;
        }, false);
    
        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection