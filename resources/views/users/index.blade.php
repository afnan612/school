@extends('users.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>قائمة المستخدمين</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('create_user') }}"> Create New user</a>
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
            <th scope="col">email</th>
{{--            <th scope="col">password</th>--}}
            <th scope="col">image</th>
            <th scope="col">degree</th>
            <th scope="col">المدرسة</th>
            <th scope="col">Actions</th>

        </tr>
        </thead>
        <tbody>

        <?php $i = 0; ?>
        @foreach ($users as $user)
                <?php $i++; ?>
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
{{--                <td>{{ $user->password }}</td>--}}
                <td > <img src="{{ asset($user->image) }}"  style="width: 80px" height="80px" border-radius="50%" ></td>
                <td>{{ $user->degree }}</td>
                <td>{{ optional($user->school)->name }}</td>

{{--                <td>{{ $user->school->name }}</td>--}}

                <td>
                    <form action="{{ route('users.destroy',$user->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>

        @endforeach
        </tbody>
    </table>

    {!! $users->links() !!}

@endsection
