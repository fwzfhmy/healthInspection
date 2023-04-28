@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Welcome '.$user->fullName.'!') }}</div>

                <div class="card-body">
                    @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                    </div>
                    @endif
                    <img src="{{!$user->imagePath ? Storage::url('images/default.jpg' ):Storage::url('images/' . $user->imagePath) }}"
                        class="img-circle " alt="{{ $user->imagePath }}"
                        style="object-fit: cover; width: 70px; height:70px;">
                    <br><br>
                    <p>
                        Name: {{$user->fullName}} <br>
                        Matric ID: {{$user->matricId}} <br>
                        Course: {{$user->course}}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Active Appointment</div>

                <div class="card-body">
                    <h5>Counselling Session with {{$appointment->counselor->fullName}}</h5>
                    <h6> {{ Carbon\Carbon::parse($appointment->appointmentDateTime)->format('D d F Y - g:i A')}}</h6>
                    <p>Platform: {{$appointment->method}} <br> Counsellor: {{$appointment->counselor->fullName}}</p>
                    <a type="button" href="{{route('client.appointments.show',$appointment->id) }}"
                        class="btn btn-primary">See More</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection