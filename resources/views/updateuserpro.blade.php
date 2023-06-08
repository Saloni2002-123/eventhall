@extends('layouts.mainUser')
@section('content')
<div class="update-form">
  <form method="POST" action="/edituser">
    @csrf
    @if (Session('success'))
    <div class="alert alert-success" style="font-size: 14px; padding: 5px; width: 60%; margin: 0 auto;">{{Session::get('success')}}</div>
    @endif
    @if (Session('fail'))
    <div class="alert alert-danger" style="font-size: 14px; padding: 5px; width: 60%; margin: 0 auto;">{{Session::get('fail')}}</div>
    @endif
    <input type="hidden" name="id" value="{{$data->id}}">
    <div class="form-group">
      <label for="first_name">First Name:</label>
      <input type="text" id="first_name" name="first_name" value="{{ $data['first_name']}}">
    </div>
    <div class="form-group">
      <label for="last_name">Last Name:</label>
      <input type="text" id="last_name" name="last_name" value="{{$data['last_name']}}">
    </div>
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" value="{{ $data['name'] }}" >
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" value="{{$data['email']}}">
    </div>
  
    <div class="form-group">
      <label for="phone_no">Phone Number:</label>
      <input type="number" id="phone_no" name="phone_no" value="{{$data['phone_no']}}">
    </div>
    <div class="form-group">
      <button type="submit">Update Profile</button>
    </div>
  </form>
</div>
@endsection