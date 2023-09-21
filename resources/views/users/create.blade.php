
@extends('users.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New user</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

                <div class="form-group">
                    <label >name</label>
                    <input type="name" class="form-control" name="name" placeholder="name">
                </div>

                <div class="form-group">
                    <label >email</label>
                    <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label >password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>

                <div class="form-group">
                    <label >image</label>
                    <input type="file" class="form-control-file" name="image" >
                </div>

        <div class="form-group">
            <label >الدرجة</label>
            <input type="name" class="form-control" name="degree" placeholder="درجة الطالب">
        </div>

        <div class="col">
            <label for="inputName" class="control-label">المدرسة</label>
            <select name="school_id" class="form-control SlectBox js-example-basic-multiple" >
                <option value="" selected disabled>حدد المدرسة</option>
                @foreach ($schools as $school)
                    <option value="{{ $school->id }}"> {{ $school->name }}</option>
                @endforeach
            </select>
        </div>

{{--        <div class="col">--}}
{{--            <label for="inputName" class="control-label">المدرسة</label>--}}
{{--            <select name="school_id" class="form-control SlectBox" onclick="console.log($(this).val())"--}}
{{--                    onchange="console.log('change is firing')"><placeholder>--}}
{{--                    <option value="" selected disabled>حدد المدرسة</option>--}}
{{--                    @foreach ($schools as $school)--}}
{{--                        <option value="{{ $school->id }}"> {{ $school->name }}</option>--}}
{{--                @endforeach--}}
{{--            </select>--}}
{{--        </div>--}}

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

@endsection
