@extends('layouts.mainUser')
@section('content')




<div class="user-table">
      <div class="card">
        <div class="card-header">My Booking History</div>
        <div class="card-body">
            @foreach($result as $row)
          <form>
            <div class="form-grp">
              <label>ID:</label>
                <input type="text" id="id"value="{{ $row-> id }}" readonly>
            </div>
            <div class="form-grp">
              <label >Hall Name:</label>
             
                <input type="text" id="hall_name"value="{{$row->hall_name}}" readonly>
             
            </div>
            <div class="form-grp">
            <label for="services">Services</label>
            <input  type="text"  id="service_name" value="@foreach($row->services as $serve)
                {{ $serve->name }}
            @endforeach" readonly>
        </div>
          
            <div class="form-grp">
              <label >Event Schedule:</label>
            
                <input type="date" id="event_schedule" value="{{$row->event_schedule}}" readonly>
           
            </div>
            <div class="form-grp">
              <label>Total Guest:</label>
             
                <input type="number" id="total_guests"value='{{$row->total_guests}}' readonly>
            
            </div>
            <div class="form-grp">
              <label>Status:</label>
             
              <button type="button" id="status" value='{{$row->status}}'>{{$row->status}}</button>
            
            </div>
          </form>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
