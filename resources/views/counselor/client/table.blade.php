@section('content')
<div class="row">
    <div class="col-lg-6 margin-tb">
        <div class="pull-left">
            counselor/client/table/index
            <h2>Clients</h2>
        </div>
        {{-- <div class="pull-right">
            <a class="btn btn-success" href="{{ route('counselor.clients.create') }}">Create Appointment</a>
        </div> --}}
    </div>
</div>
<br>
@if (Session::get('success'))
<div class="alert alert-success">
    <p>{{ Session::get('success') }}</p>
</div>
@endif
<!-- client modal  -->
@foreach ($clients as $client)
<div class="modal fade" id="client-modal-{{ $client->id }}" tabindex="-1" role="dialog"
    aria-labelledby="client-modal-{{ $client->id }}-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="client-modal-{{ $client->id }}-label">{{ $client->client->fullName }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="{{! $client->client->imagePath ? Storage::url('images/default.jpg' ):Storage::url('images/' .  $client->client->imagePath) }}"
                    class="img-circle " alt="{{  $client->client->imagePath }}"
                    style="object-fit: cover; width: 70px; height:70px;">
                <table>
                    <tr>
                        <td width="100px">Name</td>
                        <td>{{$client->client->fullName}}</td>
                    </tr>
                    <tr>
                        <td>Matric ID</td>
                        <td>{{$client->client->matricId}}</td>
                    </tr>
                    <tr>
                        <td>Course</td>
                        <td>{{$client->client->course}}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{$client->client->email}}</td>
                    </tr>
                    <tr>
                        <td>Phone No</td>
                        <td>{{$client->client->phoneNo}}</td>
                    </tr>
                    <tr>
                        <td>Faculty</td>
                        <td>{{$client->client->faculty}}</td>
                    </tr>
                </table>

                <!-- Add any other information you want to display here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<table class="table table-bordered">
    <tr>
        <th>#</th>
        <th>Date</th>
        <th width="280px">Client</th>
        <th>Action</th>
    </tr>

    @foreach ($clients as $t)
    <tr>
        <td>{{ $loop->index + 1 }}</td>
        <td>{{ \Carbon\Carbon::parse($t->created_at)->format('j F Y')}}</td>
        <td>{{ $t->client->fullName }}</td>
        <td>

            <form action="{{ route('counselor.clients.destroy',$t->id) }}" method="POST">


                <a class="btn" data-toggle="modal" data-target="#client-modal-{{ $t->id }}">View Profile</a>

                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

<script>
    $(document).ready(function () {
        $('a[data-toggle="modal"]').on('click', function () {
            var target = $(this).data('target');
            $(target).modal('show');
        });
    });
</script>