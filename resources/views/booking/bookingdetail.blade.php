@extends('layouts.admindash')

@section('content')
<link rel="stylesheet" href="{{asset('css/admindash1.css')}}">
<style>
    .status-btn {
        color:white;
    }

    .status-btn.pending {
        background-color: #FFA07A; /* Customize the color for the 'Pending' status */
    }

    .status-btn.confirmed {
        background-color: green; /* Customize the color for the 'Confirmed' status */
    }

    .status-btn.done {
        background-color: #00FF00; /* Customize the color for the 'Done' status */
    }

    .status-btn.cancelled {
        background-color: #FF0000; /* Customize the color for the 'Cancelled' status */
    }
</style>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('fail'))
    <div class="alert alert-danger">
        {{ session('fail') }}
    </div>
@endif
<div class="member-table">
<h1>&nbsp;&nbsp;Booking Details</h1>
<table class="table">
  <thead class="thead-dark">
    <tr style="background-color:#69A4A0;">
      <th scope="col">Id</th>
      <th scope="col">Customer Name</th>
      <th scope="col">Hall Name</th>
      <th scope="col">Services</th>
      <th scope="col">Event Schedule</th>
      <th scope="col">Total Guests</th>
      <th scope="col">Status</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
      @forelse($result as $booking)
        <tr>
        <th scope="row">{{$booking->id}}</th>
        <td>{{$booking->user_name}}</td>
        <td>{{$booking->hall_name}}</td>
        <td>@foreach($booking->services as $serve)
                {{ $serve->name }}<br/>
            @endforeach</td>
        <td>{{$booking->event_schedule}}</td>
        <td>{{$booking->total_guests}}</td>
        <td><button class="status-btn {{$booking->status == 'Pending' ? 'pending' : ($booking->status == 'Confirmed' ? 'confirmed' : ($booking->status == 'Done' ? 'done' : 'cancelled'))}}">{{$booking->status}}</button></td>
      
        <td><a href="{{ route('booking.edit', ['id' => $booking->id]) }}" class="btn btn-success"><i class='fa fa-edit'></i></a></td>
        <td><a href="delete/booking/{{$booking->id}}" class="btn btn-danger"><i class='fa fa-trash'></i></a></td>
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
