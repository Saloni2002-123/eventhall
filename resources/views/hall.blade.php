@extends('layouts.admindash')
@section('navbar')
@endsection
@section('content')
@section('sidebar')
@endsection
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
                <td>{{ $hall->status }}</td>
                <td><a href="edithall/{{$hall->id}}" class="btn btn-success">Edit</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection