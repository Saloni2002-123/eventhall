
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
    <link rel="stylesheet" href="{{asset('css/usertable.css')}}">
    <link rel="stylesheet" href="{{asset('css/userreg.css')}}">
    <link rel="stylesheet" href="{{asset('css/userlogin.css')}}">
    <link rel="stylesheet" href="{{asset('css/aboutus.css')}}">
    <link rel="stylesheet" href="{{asset('css/eventhall.css')}}">
    <link rel="stylesheet" href="{{asset('css/service.css')}}">
    <title>User </title>
    <style>
     nav ul li.active {
  color:black;
   background: #fff;
  
}
    </style>
</head>
<body>
<nav>
    <div class="logo"><a href="{{asset('home')}}"><img src="/img/logo.png" alt=""></a></div>
    <input type="checkbox" id="click">
    <label for="click" class="menu-btn">
        <i class="fa fa-bars"></i>
    </label>
    <ul>
        <li class="{{ request()->is('useraboutus') ? 'active' : '' }}"><a href="{{asset('useraboutus')}}">About Us</a></li>
        <li class="{{ request()->is('usereventhall') ? 'active' : '' }}"><a href="{{asset('usereventhall')}}">Event hall</a></li>
        <li class="{{ request()->is('userservice') ? 'active' : '' }}"><a href="{{asset('userservice')}}">Services</a></li>
        <li class="{{ request()->is('profile') ? 'active' : '' }}"><a href="{{route('profile')}}">Profile</a></li>
        <li class="{{ request()->is('booking.history') ? 'active' : '' }}"><a href="{{route('booking.history')}}">Booking</a></li>
        @if(session('loginId'))
        <?php $user = \App\Models\User::find(session('loginId')); ?>
        @if($user)
        <li><a class="user-name">Hello {{ $user->name }}</a></li>
        <li><a href="{{ route('logout-user') }}">Logout</a></li>
        @endif
        @else
        <li><a href="#">Login</a>
            <ul id="submenu">
                <li><a href="{{route('user.log')}}">Customer</a></li>
                <li><a href="{{route('adm.log')}}">Admin</a></li>
            </ul>
        </li>
        @endif
    </ul>
</nav>

    </body>
</html>