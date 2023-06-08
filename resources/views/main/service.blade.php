@extends('layouts.master')
@section("content")
<main>
    <h4>Facilities Available
    </h4>
        <section class="services">
        @foreach($services as $key => $service)
            @if($key >= 4)
                @break
            @endif
            <div class="service-card">
            <img src="{{ asset('img/' . (($service->name)) . '.jpg') }}" alt="{{ $service->name }}"> 
                <h2>{{ $service->name }}</h2>
                <p>{{ $service->description }}</p>
            </div>
            @endforeach
        </section>
        <section class="complementary">
            <div class="comp-services">
                <p>ALong with the above services basic audio-visual, lighting, sound equipments and direct Wi-Fi access services are provided as complementary services </p>
            </div>

        </section>
        <section class="pricing">
            <div class="pricing-details">
                <h2>Pricing and other details</h2>
                <p>
    The charge for the event hall without any services included is Rs. 20,000. However, the charge can vary based on the different packages that customers prefer and the number of guests (pax) attending the event. The pricing ranges from Rs. 20,000 to Rs. 1 lakh or above, providing flexibility to suit different budgets and requirements.
</p>
<p>
    We offer two different menu options for catering: Corporate menu and Normal event menu. These menus are designed to cater to different types of events and dining preferences. Whether you're hosting a professional corporate gathering or a regular event, we have menus tailored to meet your specific needs and provide a delectable dining experience for your guests.
</p>
            </div>

        </section>
    </main>
@endsection