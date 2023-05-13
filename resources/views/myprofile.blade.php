@extends('layouts.mainUser')
@section('content')
<div class="user-table">
      <div class="card">
        <div class="card-header">My Profile</div>
        <div class="card-body">
            @foreach($result as $row)
          <form>
            <div class="form-grp">
              <label>ID:</label>
                <input type="text" id="id"value="{{ $row-> id }}" readonly>
            </div>
            <div class="form-grp">
              <label >Full Name:</label>
             
                <input type="text" id="name"value="{{ $row->first_name }} {{ $row->last_name }}" readonly>
             
            </div>
            <div class="form-grp">
              <label >Username:</label>
             
                <input type="text" id="username" value="{{ $row-> name }}" readonly>
          
            </div>
            <div class="form-grp">
              <label >Email:</label>
            
                <input type="email" id="email" value="{{ $row->email }}" readonly>
           
            </div>
            <div class="form-grp">
              <label>Phone Number:</label>
             
                <input type="number" id="phone"value='{{ $row->phone_no }}' readonly>
            
            </div>
            <div class="form-grp">
                <button type="button"> <a href="edituser/{{$row->id}}" class="btn btn-primary">Update profile</a></button>
              </div>
            </div>
          </form>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
