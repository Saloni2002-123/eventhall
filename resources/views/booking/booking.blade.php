@extends('layouts.mainUser')
@include('status')
@section('content')
<div class="booking-table">
    <div class="card">
        <div class="card-header">My Booking History</div>
        <div class="card-body">
                @foreach($result as $booking)
                    <div class="booking-item">
                        <form>
                            <div class="form-group">
                                <label>ID:</label>
                                <input type="text" id="id" value="{{ $booking->id }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Hall Name:</label>
                                <input type="text" id="hall_name" value="{{ $booking->hall_name }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="services">Services:</label>
                                <input type="text" id="service_name" value="@foreach($booking->services as $serve){{ $serve->name }}, @endforeach" readonly>
                            </div>
                            <div class="form-group">
                                <label>Event Schedule:</label>
                                <input type="datetime-local" id="event_schedule" value="{{ $booking->event_schedule }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Total Guests:</label>
                                <input type="number" id="total_guests" value="{{ $booking->total_guests }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Status:</label>
                                <button type="button" id="status" value="{{ $booking->status }}" class="status-button {{ getStatusColorClass($booking->status) }}">{{ $booking->status }}</button>
                            </div>
                        </form>
                    </div>
                @endforeach
            
        </div>
    </div>
</div>
@endsection
