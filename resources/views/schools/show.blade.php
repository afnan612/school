@extends('schools.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show schools</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('schools.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $school->name }}
            </div>
            <div class="form-group">
                <strong>address:</strong>
                {{ $school->address }}
            </div>

           <div class="form-group">
                <strong>phone:</strong>
                {{ $school->phone }}
            </div>

            <div class="form-group">
                <strong>image:</strong>
                <img src="{{ asset($school->image) }}" style="width: 80px" height="80px" border-radius="50%" >
            </div>

        <div class="form-group">
            <strong>teachers_number:</strong>
            {{ $school->teachers_number }}
        </div>

        <div class="form-group">
            <strong>minimum_admission:</strong>
            {{ $school->minimum_admission }}
        </div>

    </div>
@endsection
