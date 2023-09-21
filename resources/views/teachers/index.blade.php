@extends('teachers.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>قائمة المدرسين</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('teachers.create') }}"> Create New user</a>
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
            <th scope="col">المدرسة</th>
{{--            <th scope="col">المرفقات</th>--}}

            <th scope="col">Actions</th>

        </tr>
        </thead>
        <tbody>

        <?php $i = 0; ?>
        @foreach ($teachers as $teacher)
                <?php $i++; ?>
            <tr>
                <td>{{ $teacher->id }}</td>
                <td>{{ $teacher->name }}</td>
                <td>{{ $teacher->address }}</td>
                <td>{{ $teacher->phone }}</td>
                <td > <img src="{{ asset($teacher->image) }}"  style="width: 80px" height="80px" border-radius="50%" ></td>

                <td>
                    @foreach ($teacher->schools as $school)
                        {{ $school->name }},
                    @endforeach
                </td>

{{--                <td>--}}
{{--                    @foreach ($teacher->attachments as $attachment)--}}
{{--                        <img src="{{ asset($attachment->file_name) }}" style="width: 80px; height: 80px; border-radius: 50%;">--}}
{{--                    @endforeach--}}
{{--                </td>--}}

{{--                                                <td>{{ $teacher->school_id }}</td>--}}

{{--                <td>{{ $teacher->school->name }}</td>--}}

                <td>
                    <form action="{{ route('teachers.destroy',$teacher->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('teachers.show',$teacher->id) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('teachers.edit',$teacher->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>

        @endforeach
        </tbody>
    </table>

    {!! $teachers->links() !!}

@endsection
