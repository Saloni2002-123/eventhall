@extends('layouts.admindash')

@section('content')
<link rel="stylesheet" href="{{asset('css/admindash1.css')}}">

<form action="/editmember" method="POST" class="editcustomer" style="width:70%;margin-left:5vh;">
    <br>
<fieldset  style="padding:30px; border:4px solid  #7C9CBA; width:90%; align-items:center;">
<legend><h3>&nbsp;&nbsp;Edit Customer</h3></legend>
@csrf</b> <input type="hidden" name="id" value="{{$data['id']}}">
 &nbsp;&nbsp;<b>First Name: </b><input type="text" name="first_name" value="{{$data['first_name']}}">&nbsp;&nbsp;
 &nbsp;&nbsp;<b>Last Name: </b> <input type="text" name="last_name" value="{{$data['last_name']}}">&nbsp;&nbsp;<br><br>
 &nbsp;&nbsp;<b>UserName: </b> <input type="text" name="name" value="{{$data['name']}}">&nbsp;&nbsp;
  <br><br> &nbsp;&nbsp;<b>Phone No.: </b> <input type="number" name="phone_no" value="{{$data['phone_no']}}">&nbsp;&nbsp;
 <br><br>&nbsp;&nbsp;<b>Email: </b><input type="text" name="email" value="{{$data['email']}}"><br><br>
 &nbsp;&nbsp;<button style="border-color:#3a4e7a; background-color:#c1e3ff; color:black;"type="submit" name="submit">Edit</button>
 </fieldset>
</form>

@endsection