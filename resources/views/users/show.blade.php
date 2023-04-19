@extends('layouts.template')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show User Details</h2>
        </div>
    </div>
</div>

<div class="row">
    @if($user->imagePath)
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <div class="image-preview">

                <img src="{{ Storage::url('images/' . $user->imagePath) }}" alt="Current Image"
                    style="max-width:200px; border-radius:50%;">



            </div>
        </div>
    </div>
    @else
    <br>
    {{-- <img src="{{ asset('default-image.png') }}" alt="Default Image" style="max-width:200px; border-radius:50%;">
    --}}
    @endif
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $user->fullName }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $user->fullName }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Identification No:</strong>
            {{ $user->idNo }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:</strong>
            {{ $user->email }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Date of birth:</strong>
            {{ $user->dateBirth ? \Carbon\Carbon::parse($user->dateBirth)->format('Y-m-d') : '-' }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Address:</strong>
            {{ $user->address }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Joined On:</strong>
            {{ $user->created_at }}
        </div>
    </div>
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
    </div>
</div>
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
@endsection