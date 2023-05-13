@extends('layouts.admindash')
@section('navbar')
@endsection
@section('content')
@section('sidebar')
@endsection
<div class="member-table">
<h1>&nbsp;&nbsp;<u>Customer's Details</u></h1>
<table class="table">
  <thead class="thead-dark">
    <tr style="background-color:#69A4A0;">
      <th scope="col">Id</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Phone No.</th>
      <th scope="col">Email</th>
      <th scope="col">username</th>
      <th scope="col">Regdate</th>
      <!-- <th scope="col">Active</th> -->
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
      @forelse($members as $user)
        <tr>
        <th scope="row">{{$user->id}}</th>
        <td>{{$user->first_name}}</td>
        <td>{{$user->last_name}}</td>
        <td>{{$user->phone_no}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->name}}</td>
        <td>{{$user->created_at->todatestring()}}</td>
        <!-- <td>
        <input data-id="{{$user->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="yes" data-off="no" {{ $user->active=='yes' ? 'checked' : '' }}>
        </td> -->
        <td><a href="editmember/{{$user->id}}" class="btn btn-success">Edit</a></td>
        <td><a href="deletemember/{{$user->id}}" class="btn btn-danger">Delete</a></td>
        </tr>
    @empty
        <tr>
            <td colspan="12">No Member Enlisted</td>
        </tr>

    @endforelse
  </tbody>
</table>
</div>
@endsection