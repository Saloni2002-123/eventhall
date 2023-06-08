@extends('layouts.login')
@section("content")
<div class="register-usr">
    <div class="wrapper-user">
            <div class="form-box-register">
              
             <form action="{{route('user.reg')}}"method="post">
                @if(Session::has('success'))
                    <div class="alert alert-success" style="font-size: 14px; padding: 5px; width: 60%; margin: 0 auto;">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail'))
                    <div class="alert alert-danger" style="font-size: 14px; padding: 5px; width: 60%; margin: 0 auto;">{{Session::get('fail')}}</div>
                    @endif
                    @csrf
                <h2>User Register</h2>
                    <div class="input-usr">
                        <span class="icon"><i class="fa fa-thin fa-user"></i></span>
                        <input type="text" name="first_name" placeholder="Firstname"required>
                       
                        <span class="text-danger">@error('firstname'){{$message}}@enderror</span>

                    </div>

                    <div class="input-usr">
                        <span class="icon"><i class="fa fa-thin fa-user"></i></span>
                        <input type="text" name="last_name" placeholder="Lastname"required>
                        <span class="text-danger">@error('lastname'){{$message}}@enderror</span>

                    </div>

                    <div class="input-usr">
                        <span class="icon"><i class="fa fa-solid fa-envelope"></i></span>
                        <input type="email" name="email" placeholder="Email"required>
                        <span class="text-danger">@error('email'){{$message}}@enderror</span>

                    </div>

                    <div class="input-usr">
                        <span class="icon"><i class="fa fa-regular fa-user"></i></span>
                        <input type="username" name="name" placeholder="Username"required>
                        <span class="text-danger">@error('name'){{$message}}@enderror</span>

                    </div>
                    <div class="input-usr">
                        <span class="icon"><i class="fa fa-solid fa-lock"></i></span>
                        <input type="password" name="password" placeholder="Password"required>
                       
                        <span class="text-danger">@error('password'){{$message}}@enderror</span>

                    </div>
                    <div class="input-usr">
                        <span class="icon"><i class="fa fa-solid fa-phone"></i></span>
                        <input type="number" name="phone_no" placeholder="Phone Number"required>
                       
                        <span class="text-danger">@error('phone_no'){{$message}}@enderror</span>

                    </div>
                    <button type="submit" class="btn-user">Submit</button>
                </form>
            </div>
    </div>
 </div>
@endsection