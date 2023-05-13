<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
    <link rel="stylesheet" href="{{asset('css/adminlogin.css')}}">
    <link rel="stylesheet" href="{{asset('css/adminreg.css')}}">
    <link rel="stylesheet" href="{{asset('css/userreg.css')}}">
    <link rel="stylesheet" href="{{asset('css/userlogin.css')}}">
    <link rel="stylesheet" href="{{asset('css/aboutus.css')}}">
    <link rel="stylesheet" href="{{asset('css/eventhall.css')}}">
    <title>Event booking</title>
</head>
<body>
    {{View::make('layouts.header')}}
    @yield('content')
    {{View::make('layouts.footer')}}
</body>
</html>