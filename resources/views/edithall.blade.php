@extends('layouts.admindash')
@section('navbar')
@endsectiom
@section('sidebar')
@endsection
@section('content')
<form action="/edithall" method="POST">
    <br>
<fieldset  style="padding:30px; border:4px solid #69A4A0;">
<legend><h4>&nbsp;&nbsp;<u>Edit Hall</u></h4></legend>
@csrf
 &nbsp;&nbsp;<b>Hall Name: </b><input type="text" name="name" value="{{$data['name']}}">&nbsp;&nbsp;
 &nbsp;&nbsp;<b>Description: </b> <input type="text" name="description" value="{{$data['description']}}">&nbsp;&nbsp;
 <label>Status:</label>
    <select name="status">
        <option value="active" {{ $data->status == 'available' ? 'selected' : '' }}>Available</option>
        <option value="inactive" {{ $data->status == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
    </select>
 &nbsp;&nbsp;<button style="border-color:#FFA07A; background-color:#FFA07A;" type="submit" name="submit">Edit</button>

 </fieldset>
</form>
@if(session('fail'))
    <div class="alert alert-danger">
        {{ session('fail') }}
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@stop
@endsection