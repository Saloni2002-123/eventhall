<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/admindash.css')}}">
    <link rel="stylesheet" href="{{asset('css/adminnav.css')}}">
    <link rel="stylesheet" href="{{asset('css/member.css')}}">
    <link rel="stylesheet" href="{{asset('css/edit.css')}}">
        <title>Admin Dashboard</title>
</head>
<body>
  
<nav class="admin-nav">
  <div class="logo-admin">
    <a href="#"><img src="/img/logo.png" alt="Logo"></a>
    <a href="{{route('home')}}">Event Hall Booking System - Admin</a>
  </div>
  <div class="greeting">
    <div class="dropdown">
      <button class="dropbtn">
        @if(Auth::guard('admin')->check())
           Hello {{Auth::guard('admin')->user()->username}}
           @endif
      </button>
    </div>
  </div>
</nav>

<div class="main-content">
  @yield('content')   
  <section class="content-admin">
    <div class="sidebar-admin">
      <div class="text-admin">
        <h4>Dashboard</h4>
        <ul>
          <li><a href="{{route('customer')}}"><i class="fa fa-sharp fa-solid fa-users"></i>Customers list</a></li>
          <li><a href="#"><i class="fa fa-solid fa-calendar"></i>Booking Application</a></li>
        </ul>
        <h4>Maintenance</h4>
        <ul>
          <li><a href="{{route('hall')}}"><i class="fa fa-door"></i>Halls list</a></li>   
          <li><a href="#"><i class="fa fa-solid fa-plate-utensils"></i>Services list</a></li>
        </ul>
        <ul>
          <li><a href="{{route('logout-admin')}}"><i class="fa fa-solid fa-plate-utensils"></i>Logout</a></li>
        </ul>
      </div> 
    </div>
  </section>
</div>


</body>
</html>