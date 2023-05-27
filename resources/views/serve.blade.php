@extends('layouts.admindash')
@section('content')
<link rel="stylesheet" href="{{asset('css/admindash1.css')}}">
<div class="member-table">
<h1>&nbsp;&nbsp;<u>Service Details</u></h1>
<table class="table">
  <thead class="thead-dark">
    <tr style="background-color:#69A4A0;">
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Desription</th>
      <th scope="col">Status</th>
      <th scope="col">Edit</th>
    </tr>
  </thead>
  <tbody>
        @foreach ($services as $service)
            <tr>
                <td>{{ $service->id }}</td>
                <td style="text-align:justify;">{{ $service->name }}</td>
                <td style="text-align:justify;">{{ $service->description }}</td>
                <td >@if ($service->status == 'active')
            <button class="status-btn-hall status-active">{{ $service->status }}</button>
          @else
            <button class="status-btn-hall status-inactive">{{ $service->status }}</button>
          @endif</td>
                <td><a href="editservice/{{$service->id}}" class="btn btn-success">Edit</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection