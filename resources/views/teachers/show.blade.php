@extends('teachers.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show users</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('teachers.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $teacher->name }}
        </div>
        <div class="form-group">
            <strong>address:</strong>
            {{ $teacher->address }}
        </div>

        <div class="form-group">
            <strong>phone:</strong>
            {{ $teacher->phone }}
        </div>

        <div class="form-group">
            <strong>image:</strong>
            <img src="{{ asset($teacher->image) }}" style="width: 80px" height="80px" border-radius="50%" >
        </div>

        <div class="form-group">
            <strong>المدرسة:</strong>
            @foreach ($teacher->schools as $school)
                {{ $school->name }},
            @endforeach
{{--            {{  $teacher->school->name}}--}}
        </div>

        <div class="form-group">
            <strong>Attachments:</strong>
            @foreach ($teacher->attachments as $attachment)
                <img src="{{ asset($attachment->file_name) }}" style="width: 80px; height: 80px; border-radius: 50%;">
            @endforeach
        </div>


    </div>
@endsection
