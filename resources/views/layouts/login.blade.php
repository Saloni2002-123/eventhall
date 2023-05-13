<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
    <link rel="stylesheet" href="{{asset('css/adminlogin.css')}}">
    <link rel="stylesheet" href="{{asset('css/adminreg.css')}}">
    <link rel="stylesheet" href="{{asset('css/userreg.css')}}">
    <link rel="stylesheet" href="{{asset('css/userlogin.css')}}">
    <title>Event booking</title>
</head>
<body>
    {{View::make('layouts.header')}}
    @yield('content')
</body>
</html>