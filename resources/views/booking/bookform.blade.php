@extends('layouts.mainUser')

@section('content')
<div class="booking-f">


    <div class="booking-form">
      
        <h2>Booking Form</h2>

        <form action="{{ route('booking.store') }}" method="POST">
            @csrf
            <div class="curve">
        </div>
            @if (Session::has('success'))
    <div class="alert alert-success" style="font-size: 14px; padding: 5px; width: 60%; margin: 0 auto;">{{Session::get('success')}}</div>
    @endif
    @if (Session::has('fail'))
    <div class="alert alert-danger" style="font-size: 14px; padding: 5px; width: 60%; margin: 0 auto;">{{Session::get('fail')}}</div>
    @endif
    <div class="booking-form-group">
    <label for="hall">Hall</label>
    <select name="hall_id" id="hall" class="form-control" required>
        @foreach ($halls as $hall)
            @if ($hall->status == 'available')
                <option value="{{ $hall->id }}">{{ $hall->name }}</option>
            @endif
        @endforeach
    </select>
</div>

<div class="booking-form-group">
    <label for="services">Services</label>
    @foreach ($services as $service)
        @if ($service->status == 'available')
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="services[]" id="service{{ $service->id }}" value="{{ $service->id }}">
                <label class="form-check-label" for="service{{ $service->id }}">{{ $service->name }}</label>
            </div>
        @endif
    @endforeach
</div>


            <div class="booking-form-group">
                <label for="guests">Total Number of Guests</label>
                <input type="number" name="total_guests" id="guests" class="form-control" required>
            </div>

            <div class="booking-form-group">
                <label for="schedule">Event Schedule</label>
                <input type="datetime-local" name="event_schedule" id="schedule" class="form-control" required>
            </div>
            <div class="booking-form-group">
                <label for="remarks">Remarks</label>
                <textarea name="remarks" id="remarks" class="form-control"></textarea>
            </div>
            <div class="booking-form-group">
            <button type="submit"class="sub">
                Submit
            </button>
            </div>
        </form>
    </div>
</div>
@endsection
