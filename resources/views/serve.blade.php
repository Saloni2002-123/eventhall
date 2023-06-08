@extends('layouts.admindash')
@section('content')
<link rel="stylesheet" href="{{asset('css/admindash1.css')}}">
<div class="member-table">
@if (Session('success'))
    <div class="alert alert-success" style="font-size: 14px; padding: 5px; width: 60%; margin: 0 auto;">{{Session::get('success')}}</div>
    @endif
    @if (Session('fail'))
    <div class="alert alert-danger" style="font-size: 14px; padding: 5px; width: 60%; margin: 0 auto;">{{Session::get('fail')}}</div>
    @endif
<h1>&nbsp;&nbsp;Service Details</h1>
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
                <td >@if ($service->status == 'available')
            <button class="status-btn-hall status-active">{{ $service->status }}</button>
          @else
            <button class="status-btn-hall status-inactive">{{ $service->status }}</button>
          @endif</td>
               
          <td><a href="editservice/{{$service->id}}" class="btn btn-success"><i class='fa fa-edit'></i></a></td>
            </tr>
        @endforeach
    </tbody>
</table>

</div>
@endsection