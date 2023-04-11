@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Health inspection</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('inspections.create') }}"> Add New inspection</a>
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
            <th>Ic No</th>
            <th>Full Name</th>
            <th>Symptoms</th>
            <th>Result</th>


            <th width="280px">Action</th>
        </tr>


        @foreach ($inspections as $t)

        <tr>
            <td>{{ $t->id }}</td>
            <td>{{ $t->user->email }}</td>
            <td>{{ $t->user->fullName }}</td>
            <td>{{ $t->noOfSymptoms }}</td>
            <td>{{ $t->result }}</td>
            <!-- <td>

            @php
            $count = 0;
            if ($t->symptom1) $count++;
            if ($t->symptom2) $count++;
            if ($t->symptom3) $count++;
            if ($t->symptom4) $count++;
            if ($t->symptom5) $count++;
            @endphp
            {{$count}}/5
            </td>
            <td>@php
                $variable ="";
                if($count>2){
                    $variable= "Positive";
                }
                else{
                    $variable = "Negative";
                }
                @endphp
                {{$variable}} -->
            </td>
            <td>
                <form action="{{ route('inspections.destroy',$t->id) }}" method="POST">

                <a class="btn btn-info" href="{{ route('inspections.show',$t->id) }}">Show</a>

                    <a class="btn btn-primary" href="{{ route('inspections.edit',$t->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
