@extends('users.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit users</h2>
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

    <form action="{{ route('users.update',$user->id) }}" method="POST"   enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>name</label>
            <input type="name" class="form-control" name="name"  value="{{ $user->name }}" placeholder="name">
        </div>

        <div class="form-group">
            <label >email</label>
            <input type="email" class="form-control" name="email" aria-describedby="emailHelp" value={{ $user->email }} placeholder="Enter email">
        </div>
        <div class="form-group">
            <label >password</label>
            <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <div class="form-group">
            <label >image</label>
            <input type="file" class="form-control-file" name="image"  value="{{ $user->image }}">
        </div>

        <div class="form-group">
            <label >الدرجة</label>
            <input type="name" class="form-control" name="degree"  value="{{ $user->degree }}" placeholder="درجة الطالب">
        </div>

        <div class="col">
            <label for="inputName" class="control-label">المدرسة</label>
            <select name="school_id" class="form-control SlectBox" onclick="console.log($(this).val())"
                    onchange="console.log('change is firing')"><placeholder>
                    <option value="" selected disabled>حدد المدرسة</option>
                    @foreach ($schools as $school)
                        <option value="{{ $school->id }}"> {{ $school->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection
