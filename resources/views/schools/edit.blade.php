@extends('schools.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit users</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('schools.index') }}"> Back</a>
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

    <form action="{{ route('schools.update',$school->id) }}" method="POST"   enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>name</label>
            <input type="name" class="form-control" name="name"  value="{{ $school->name }}" placeholder="name">
        </div>

        <div class="form-group">
            <label >address</label>
            <input type="address" class="form-control" name="address" value="{{ $school->address }}" placeholder="Enter address">
        </div>

        <div class="form-group">
            <label >phone</label>
            <input type="phone" class="form-control" name="phone" value="{{ $school->phone }}" placeholder="phone">
        </div>

        <div class="form-group">
            <label >image</label>
            <input type="file" class="form-control-file" name="image"  value="{{ $school->image }}">
        </div>

        <div class="form-group">
            <label >teachers_number</label>
            <input type="teachers_number" class="form-control" name="teachers_number" value="{{ $school->teachers_number }}" placeholder="teachers_number">
        </div>

        <div class="form-group">
            <label >minimum_admission</label>
            <input type="minimum_admission" class="form-control" name="minimum_admission" value="{{ $school->minimum_admission }}" placeholder="minimum_admission">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection
