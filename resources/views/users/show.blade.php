@extends('users.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show users</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $user->name }}
            </div>
            <div class="form-group">
                <strong>email:</strong>
                {{ $user->email }}
            </div>

{{--           <div class="form-group">--}}
{{--                <strong>password:</strong>--}}
{{--                {{ $user->password }}--}}
{{--            </div>--}}

            <div class="form-group">
                <strong>image:</strong>
                <img src="{{ asset($user->image) }}" style="width: 80px" height="80px" border-radius="50%" >
            </div>

        <div class="form-group">
            <strong>degree:</strong>
            {{ $user->degree }}
        </div>

        <div class="form-group">
            <strong>المدرسة:</strong>
            {{ $user->school->name }}
        </div>


    </div>
@endsection
