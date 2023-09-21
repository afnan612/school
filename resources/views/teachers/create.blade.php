
@extends('teachers.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New teacher</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('teachers.index') }}"> Back</a>
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

    <form action="{{ route('teachers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label >name</label>
            <input type="name" class="form-control" name="name" placeholder="name">
        </div>

        <div class="form-group">
            <label >address</label>
            <input type="address" class="form-control" name="address"  placeholder="Enter address">
        </div>
        <div class="form-group">
            <label >phone</label>
            <input type="phone" class="form-control" name="phone" placeholder="phone">
        </div>

        <div class="form-group">
            <label >صورة المدرس</label>
            <input type="file" class="form-control-file" name="image" >
        </div>
<br>

        <div class="col">
            <label for="school_select" class="control-label">المدرسة</label>
            <select id="school_select" name="school_id[]" class="form-control SlectBox js-example-basic-multiple" multiple>
                <option value="" selected disabled>حدد المدرسة</option>
                @foreach ($schools as $school)
                    <option value="{{ $school->id }}"> {{ $school->name }}</option>
                @endforeach
            </select>
        </div>
<br>
        <input type="file" class="dropify" name="attachments[]"  accept="image/png, image/gif, image/jpeg,image/jpg" multiple />


        <button type="submit" class="btn btn-primary">Submit</button>
            </form>


@endsection
