@extends('layouts.admindash')
@section('content')
<link rel="stylesheet" href="{{asset('css/admindash1.css')}}">
<div class="member-table">
<h1>&nbsp;&nbsp;<u>Hall Details</u></h1>
<table class="table">
  <thead class="thead-dark">
    <tr style="background-color:#69A4A0;">
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Desription</th>
      <th scope="col">Status</th>
      <!-- <th scope="col">Active</th> -->
      <th scope="col">Edit</th>
    </tr>
  </thead>
  <tbody>
        @foreach ($halls as $hall)
            <tr>
                <td>{{ $hall->id }}</td>
                <td style="text-align:justify;">{{ $hall->name }}</td>
                <td style="text-align:justify;">{{ $hall->description }}</td>
                <td > <button class="status-btn status-active">{{ $hall->status }}</button></td>
                <td><a href="edithall/{{$hall->id}}" class="btn btn-success">Edit</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection