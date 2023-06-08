@extends('layouts.mainUser')

@section("content")
<section class="hall-cont">
    <h1>Event Halls</h1>
    <div class="cont-h">
    @foreach($halls as $key => $hall)
            @if($key >=4)
                @break
            @endif
            <div class="box-cont-h">
                <div class="imgbox">
                    @if($key == 0)
                    <img src="{{ asset('img/Vajra Hall - 1.jpg') }}" alt="Vajra Hall">  
                    @elseif($key>0 && $key<=3)
                <img src="{{ asset('img/' . (($hall->name)) . '.jpg') }}" alt="{{ $hall->name }}">     
                @endif          
             </div>
             <h2> {{ $hall->name }}</h2>
             <div class="intro">
                
                <h1>{{ $hall->name }}</h1>
                   <p>{{ $hall->description }}</p>
                </div>
            </div>
        @endforeach
    </div>
    <section class="book">
        <h3>Discover the perfect venue for your next function with Shangrila Blu Hotel and click the button to receive a customized quote and exceptional service.</h3>
        <button><a href="{{ route('booking.form') }}">Book Now</a></button>
    </section>
   
</section>

@endsection
