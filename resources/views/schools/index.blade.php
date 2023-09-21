@extends('schools.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>قائمة المدارس</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('schools.create') }}"> Create New school</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">name</th>
            <th scope="col">address</th>
            <th scope="col">phone</th>
            <th scope="col">image</th>
            <th scope="col">teachers_number</th>
            <th scope="col">minimum_admission</th>

            <th scope="col">Actions</th>

        </tr>
        </thead>
        <tbody>

        <?php $i = 0; ?>
        @foreach ($schools as $school)
                <?php $i++; ?>
            <tr>
                <td>{{ $school->id }}</td>
                <td>{{ $school->name }}</td>
                <td>{{ $school->address }}</td>
                <td>{{ $school->phone }}</td>
                <td > <img src="{{ asset($school->image) }}"  style="width: 80px" height="80px" border-radius="50%" ></td>
                <td>{{ $school->teachers_number }}</td>
                <td> {{  $school->minimum_admission }} %</td>

                <td>
                    <form action="{{ route('schools.destroy',$school->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('schools.show',$school->id) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('schools.edit',$school->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>

        @endforeach
        </tbody>
    </table>

    {!! $schools->links() !!}

@endsection
