@section('content')
<div class="row">
    <div class="col-lg-6 margin-tb">
        <div class="pull-left">
            client/appointment/table/index
            <h2>Appointments</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('client.appointments.create') }}">Create Appointment</a>
        </div>
    </div>
</div>
<br>
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<!-- Check for success message and appointment data -->
@if (Session::get('appointment') && Session::get('success'))
<div class="modal fade" id="appointment-modal" tabindex="-1" role="dialog" aria-labelledby="appointment-modal-label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="appointment-modal-label">Appointment Booked Successfully!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table>
                    <tr>
                        <td width="100px">Counselor</td>
                        <td>{{ Session::get('appointment')->counselor->fullName }}</td>
                    </tr>
                    <tr>
                        <td>Date</td>
                        <td>{{ \Carbon\Carbon::parse(Session::get('appointment')->appointmentDateTime)->format('j F Y
                            (l)')}}
                        </td>
                    </tr>
                    <tr>
                        <td>Time</td>
                        <td>{{ \Carbon\Carbon::parse(Session::get('appointment')->appointmentDateTime)->format('h:i a')
                            }}</td>
                    </tr>
                    <tr>
                        <td>Method</td>
                        <td>{{ Session::get('appointment')->method }}</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Set Reminder</button>
            </div>
        </div>
    </div>
</div>

@endif

<table class="table table-bordered">
    <tr>
        <th>#</th>
        <th>Date/Time</th>
        <th width="280px">Counselor</th>
        <th>Room Location</th>
        <th>Action</th>
    </tr>

    @foreach ($appointments as $t)
    <tr>
        <td>{{ $loop->index + 1 }}</td>
        <td>{{ \Carbon\Carbon::parse($t->appointmentDateTime)->format('d/m/Y (h:iA)')}}</td>
        <td>{{ $t->counselor->fullName }}</td>
        <td>{{ $t->counselor->roomLocation }}</td>
        <td>
            @if($t->status== 0)
            <form action="{{ route('client.appointments.changeStatus', [$t->id, '1']) }}" method="POST">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-success">Confirm</button>
            </form>
            @endif
            {{-- @if($t->status != 4 &&$t->status != 0 )
            <a class="btn btn-danger" href="{{ route('client.appointments.show',$t->id) }}">Request to cancel</a>
            @endif --}}
            <a class="btn btn-info" href="{{ route('client.appointments.show',$t->id) }}">Show</a>

            <form action="{{ route('client.appointments.destroy',$t->id) }}" method="POST">
                {{-- <a class="btn btn-primary" href="{{ route('client.appointments.edit',$t->id) }}">Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button> --}}
            </form>
        </td>
    </tr>
    @endforeach
</table>
<!-- Load jQuery and Bootstrap JS libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>

<!-- Show the modal if the condition is true -->
@if (Session::get('appointment') && Session::get('success'))
<script>
    $(document).ready(function() {
            $('#appointment-modal').modal('show');
        });
</script>
@endif