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
                        Staff ID: {{$user->matricId}} <br>
                        Department: {{$user->department}}
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
                    <h5>Counselling Session</h5>
                    <h6> {{ Carbon\Carbon::parse($appointment->appointmentDateTime)->format('D d F Y - g:i A')}}</h6>
                    <p>Platform: {{$appointment->method}} <br> Client: {{$appointment->client->fullName}}</p>
                    <a type="button" href="{{route('counselor.appointments.show',$appointment->id) }}"
                        class="btn btn-primary">See More</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection