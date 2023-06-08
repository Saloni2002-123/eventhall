<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- CSS only
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/css/bootstrap.min.css">

 JavaScript Bundle with Popper -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/js/bootstrap.bundle.min.js"></script> --> 

    <link rel="stylesheet" href="{{asset('css/home.css')}}">
    <link rel="stylesheet" href="{{asset('css/adminlogin.css')}}">
    <link rel="stylesheet" href="{{asset('css/adminreg.css')}}">
    <link rel="stylesheet" href="{{asset('css/userreg.css')}}">
    <link rel="stylesheet" href="{{asset('css/userlogin.css')}}">
    <link rel="stylesheet" href="{{asset('css/usertable.css')}}">
    <link rel="stylesheet" href="{{asset('css/updateuserpro.css')}}">
    <link rel="stylesheet" href="{{asset('css/aboutus.css')}}">
    <link rel="stylesheet" href="{{asset('css/eventhall.css')}}">
    <link rel="stylesheet" href="{{asset('css/booking.css')}}">
    <link rel="stylesheet" href="{{asset('css/bookinghistory.css')}}">
   
    <title>Event booking</title>
</head>
<body>
    {{View::make('layouts.usernav')}}
    @yield('content')
    {{View::make('layouts.footer')}}

</body>
</html>