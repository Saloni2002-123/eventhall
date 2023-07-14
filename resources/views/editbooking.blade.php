@extends('layouts.admindash')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admindash1.css') }}">

<form action="{{ route('booking.update', $data->id) }}" method="POST" class="editbooking" style="width:82%;margin-left:5vh;display:flex; align-items:center;">
   @csrf
    <br>
    <fieldset style="padding:30px; border:4px solid #7C9CBA; width:80%;">
        <legend>
            <h3>&nbsp;&nbsp;Edit Booking</h3>
        </legend>
        <input type="hidden" name="id" value="{{ isset($data->id) ? $data->id : '' }}">
        &nbsp;&nbsp;<b>User Name: </b><input type="text" name="user_name" value="{{ isset($data->user_name) ? $data->user_name : '' }}">&nbsp;&nbsp;
        &nbsp;&nbsp;<b>Hall Name: </b> <input type="text" name="hall_name" value="{{ isset($data->hall_name) ? $data->hall_name : '' }}">&nbsp;&nbsp;
        <br><br>&nbsp;&nbsp;<b>Service: </b><br>
        @foreach ($services as $service)
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="services[]" id="service{{ $service->id }}"
                value="{{ $service->id }}"
                {{ in_array($service->id, $data->services->pluck('id')->toArray()) ? 'checked' : '' }}>
            <label class="form-check-label" for="service{{ $service->id }}">{{ $service->name }}</label>
        </div>
        @endforeach
        <br>&nbsp;&nbsp;<b>Event Schedule: </b><input type="datetime-local" name="event_schedule" value="{{ isset($data->event_schedule) ? $data->event_schedule : '' }}"><br>
        <br>&nbsp;&nbsp;<b>Total guests: </b><input type="number" name="total_guests" value="{{ isset($data->total_guests) ? $data->total_guests : '' }}"><br>
        <br>&nbsp;&nbsp;<b>Status: </b>
        <select name="status">
            <option value="Pending" {{ $data->status == 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="Confirmed" {{ $data->status == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
            <option value="Done" {{ $data->status == 'Done' ? 'selected' : '' }}>Done</option>
            <option value="Cancelled" {{ $data->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select><br><br>
        &nbsp;&nbsp;<b>Remarks: </b> &nbsp;<textarea id="remarks" rows="3" name="remarks">{{ $data->remarks }}</textarea>&nbsp;&nbsp;<br>

        &nbsp;&nbsp;<button
            style="border-color:#3a4e7a; background-color:#c1e3ff; color:black;" type="submit" name="submit">Edit</button>
    </fieldset>
</form>

@endsection
