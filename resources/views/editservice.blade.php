@extends('layouts.admindash')
@section('sidebar')
@section('content')
<form action="/editservice" method="POST">
    <br>
<fieldset  style="padding:30px; border:4px solid #7C9CBA;">
<legend><h4>&nbsp;&nbsp;<u>Edit Service</u></h4></legend>
@csrf
&nbsp;&nbsp;<b style="padding-bottom:5px;">Service ID: </b><input type="number" name="id" value="{{$data['id']}}">&nbsp;&nbsp;<br>

 &nbsp;&nbsp;<b>Service Name: </b><input type="text" name="name" value="{{$data['name']}}">&nbsp;&nbsp;<br>
 &nbsp;&nbsp;<b>Description: </b> <textarea id="description" class="form-control" rows="3" name="description">{{$data['description']}}</textarea>&nbsp;&nbsp;
 <b>Status:</b>
    <select name="status">
        <option value="available" {{ $data->status == 'available' ? 'selected' : '' }}>Available</option>
        <option value="unavailable" {{ $data->status == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
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
@endsection