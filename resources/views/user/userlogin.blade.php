@extends('layouts.login')
@section("content")
<div class="con-log">
<div class="wrapper-log">
    <div class="form-box-log ">
       
 <form action="{{route('userlog.check')}}" method="POST">
        @csrf
      @if (Session::has('success'))
    <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif
    @if (Session::has('fail'))
    <div class="alert alert-danger">{{Session::get('fail')}}</div>
    @endif
        <h2>Customer Login</h2>
            <div class="input-box-log">
                <span class="icon"><i class="fa fa-solid fa-envelope"></i></span>
                <input type="text" name="email" required>
                <label >Email</label>
            </div>
            <span class="text-danger">@error('email'){{$message}}@enderror</span>

            <div class="input-box-log">
                <span class="icon"><i class="fa fa-solid fa-lock"></i></span>
                <input type="password"name="password" required>
                <label>Password</label>
            </div>
            <span class="text-danger">@error('password'){{$message}}@enderror</span>

            <button type="submit" class="btn-log">Login</button>
            <p>Don't have an account?<a href="{{route('user.reg')}}" class="register-link">Register</a> </p>
        </form>
    </div>
</div>
</div>
@endsection