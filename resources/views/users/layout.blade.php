<!DOCTYPE html>
<html>
<head>
    <title>قائمة المستخدمين</title>



        <link href="{{asset('/bootstrap-5.3.1-dist/css/bootstrap.css')}}" rel="stylesheet">

</head>
<body>

<div class="container">
    @yield('content')
</div>

</body>
</html>

{{--<div class="col">--}}
{{--    <label for="inputName" class="control-label">المدرسة</label>--}}
{{--<select name="school" class="form-control SlectBox" onclick="console.log($(this).val())"--}}
{{--            onchange="console.log('change is firing')"><placeholder>--}}
{{--        <option value="" selected disabled>حدد المدرسة</option>--}}
{{--        @foreach ($schools as $school)--}}
{{--          <option value="{{ $school->id }}"> {{ $school->name }}</option>--}}
{{--       @endforeach--}}
{{--    </select>--}}
{{--</div>--}}
