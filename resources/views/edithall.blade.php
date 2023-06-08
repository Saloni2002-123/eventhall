@extends('layouts.admindash')
@section('sidebar')
@section('content')
<form action="/edithall" method="POST" style="margin-left:6vh; width:82%;">
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if(session('fail'))
    <div class="alert alert-danger">
        {{ session('fail') }}
    </div>
@endif
    <br>
<fieldset  style="padding:30px; border:4px solid #7C9CBA;width:60%;">
<legend><h3>&nbsp;&nbsp;Edit Hall</h3></legend>
@csrf<input type="hidden" name="id" value="{{$data['id']}}">

 &nbsp;&nbsp;<b>Hall Name: </b><input type="text" name="name" value="{{$data['name']}}">&nbsp;&nbsp;<br><br>
 &nbsp;&nbsp;<b>Description: </b> <textarea id="description" class="form-control" rows="3" name="description">{{$data['description']}}</textarea>&nbsp;&nbsp;<br>
 <b>Status:</b>
    <select name="status">
    <option value="available" {{ $data->status == 'available' ? 'selected' : '' }}>Available</option>
    <option value="unavailable" {{ $data->status == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
    </select><br><br>
 &nbsp;&nbsp;<button style="border-color:#3a4e7a; background-color:#c1e3ff; color:black;"  type="submit" name="submit">Edit</button>

 </fieldset>
</form>

@endsection