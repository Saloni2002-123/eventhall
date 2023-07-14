@extends('layouts.admindash')
@include('status')
@section('content')
<div class="admin-dashboard">
    <div class="cards">
        <div class="card">
            <div class="box">
                <h1>{{$totalHalls}}</h1>
                <h3>Halls</h3>
            </div>
            <div class="icon-case">
            <i class="fa fa-door-closed fa-2xl"></i>
            </div>
        </div>
        <div class="card">
            <div class="box">
                <h1>{{$totalServices}}</h1>
                <h3>Services</h3>
            </div>
            <div class="icon-case">
            <i class="fa fa-list fa-2xl"></i>
            </div>
        </div>
        <div class="card">
            <div class="box">
                <h1>{{$totalBookings}}</h1>
                <h3>Bookings</h3>
            </div>
            <div class="icon-case">
            <i class="fa fa-calendar-days fa-2xl"></i>
            </div>
        </div>
        <div class="card">
            <div class="box">
                <h1>{{$totalCustomers}}</h1>
                <h3>Customer</h3>
            </div>
            <div class="icon-case">
            <i class="fa fa-user fa-2xl"></i>
            </div>
        </div>
        <div class="booking-calendar">
    <h2>Booking Calendar</h2>
    <div id="calendar"></div>
</div>

<!-- Include FullCalendar CSS and JavaScript files -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

<script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            events: {!! json_encode($events) !!},
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            eventRender: function(event, element) {
                element.attr('title', event.username);
            switch (event.status) {
                case 'Pending':
                    element.css('background-color', '#92d224');
                    break;
                case 'Confirmed':
                    element.css('background-color', '#066C06');
                    break;
                case 'Done':
                    element.css('background-color', '#1a1aa1');
                    break;
                case 'Cancelled':
                    element.css('background-color', '#CF1B1B');
                    break;
                default:
                    element.css('background-color', '#ccc');
                    break;
            }
        }
        });
    });
</script>
    </div>
</div>

@endsection
