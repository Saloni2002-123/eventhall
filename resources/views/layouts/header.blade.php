<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
    <link rel="stylesheet" href="{{asset('css/aboutus.css')}}">
    <link rel="stylesheet" href="{{asset('css/eventhall.css')}}">
    <title>Landing page</title>
</head>
<body>
    <nav>
      <div class="logo"><a href="{{asset('home')}}"><img src="/img/logo.png" alt=""></a></div>
      <input type="checkbox" id="click">
      <label for="click" class="menu-btn">
        <i class="fa fa-bars"></i>
      </label>
      <ul>
        <li class="{{ request()->is('aboutus') ? 'active' : '' }}"><a href="{{asset('aboutus')}}">About Us</a></li>
        <li class="{{ request()->is('eventhall') ? 'active' : '' }}"><a href="{{asset('eventhall')}}">Event hall</a></li>
        <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="#">Services</a></li>
        <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="#">Login</a>
            <ul id="submenu">
                <li><a href="{{route('user.log')}}">Customer </a></li>
                <li><a href="{{route('adm.log')}}">Admin </a></li>
            </ul>
        </li>

      </ul>
    </nav>      
    </body>
</html>