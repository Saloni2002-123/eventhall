@extends('layouts.login')
@section("content")
<div class="con-adm">
<div class="wrapper-adm">
    <div class="form-adm">
        <h2>Admin Login</h2>
        <form action="{{route('admlog.check')}}" method="POST">
       
@csrf
@if (Session::has('success'))
<div class="alert alert-success">{{Session::get('success')}}</div>
@endif
@if (Session::has('fail'))
<div class="alert alert-danger">{{Session::get('fail')}}</div>
@endif
            <div class="input-adm">
                <span class="icon"><i class="fa fa-solid fa-envelope"></i></span>
                <input type="email" name="email"required>
                <label >Email</label>
                <span class="text-danger">@error('email'){{$message}}@enderror</span>

            </div>
            <div class="input-adm">
                <span class="icon"><i class="fa fa-solid fa-lock"></i></span>
                <input type="password" name="password" required>
                <label>Password</label>
                <span class="text-danger">@error('password'){{$message}}@enderror</span>

            </div>
            <button type="submit" class="btn-adm">Login</button>
        </form>
    </div>
</div>
</div>
@endsection