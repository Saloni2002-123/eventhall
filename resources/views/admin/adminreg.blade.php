@extends('layouts.login')
@section("content")
<div class="register-ad">
        <div class="wrapper-ad">
            <div class="form-box-reg">
                <h2>Admin Register</h2>
                <form action="{{route('admin.reg')}}" method="POST">
@if(Session::has('success'))
<div class="alert alert-success">{{Session::get('success')}}</div>
@endif
@if(Session::has('fail'))
<div class="alert alert-danger">{{Session::get('fail')}}</div>
@endif
@csrf
                    <div class="input-ad">
                        <span class="icon"><i class="fa fa-solid fa-envelope"></i></span>
                        <input type="email" name="email"required>
                        <label >Email</label>
                        <span class="text-danger">@error('email'){{$message}}@enderror</span>

                    </div>
                    <div class="input-ad">
                        <span class="icon"><i class="fa fa-regular fa-user"></i></span>
                        <input type="username" name="name"required>
                        <label >Username</label>
                        <span class="text-danger">@error('name'){{$message}}@enderror</span>

                    </div>
                    <div class="input-ad">
                        <span class="icon"><i class="fa fa-solid fa-lock"></i></span>
                        <input type="password" name="password" required>
                        <label>Password</label>
                        <span class="text-danger">@error('password'){{$message}}@enderror</span>

                    </div>
                    <button type="submit" class="btn-ad">Submit</button>
                </form>
            </div>
        </div>
        </div>
@endsection