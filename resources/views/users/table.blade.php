<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>List of Users</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('users.create') }}"> Add New User</a>
        </div>
    </div>
</div>
<br>
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Joined On</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($users as $s)
    <tr>
        <td>{{ $s->id }}</td>
        <td>{{ $s->fullName }}</td>
        <td>{{ $s->email }}</td>
        <td>{{ $s->role }}</td>
        <td>{{ $s->created_at }}</td>
        <td>
            <form action="{{ route('users.destroy',$s->id) }}" method="POST">

                <a class="btn btn-info" href="{{ route('users.show',$s->id) }}">Show</a>

                <a class="btn btn-primary" href="{{ route('users.edit',$s->id) }}">Edit</a>

                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>