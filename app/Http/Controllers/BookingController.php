<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Hall;
use App\Models\Service;
use App\Models\User;
use App\Mail\BookingConfirmation;
use Illuminate\Support\Facades\Mail;
class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId = Session::get('loginId');
    
        // Retrieve the user instance
        $user = User::find($userId);
    
        // Validate the form data
        $validatedData = $request->validate([
            'hall_id' => 'required',
            'services' => 'nullable|array',
            'total_guests' => 'required|integer',
            'event_schedule' => 'required|date_format:Y-m-d\TH:i',
            'remarks' => 'nullable|string',
        ]);
    
        // Retrieve the hall instance
        $hall = Hall::find($validatedData['hall_id']);
        if ($hall) {
            // Create a new booking instance
            $booking = new Booking();
            $booking->user_id = $user->id;
            $booking->hall_id = $hall->id;
            $booking->total_guests = $validatedData['total_guests'];
            $booking->event_schedule = $validatedData['event_schedule'];
            $booking->remarks = $validatedData['remarks'];
    
            // Save the booking instance to the database
            $booking->save();
    
            // Attach the services to the booking
            $booking->services()->attach($validatedData['services'], ['booking_id' => $booking->id]);
    
            return redirect()->route('booking.form')->with('success', 'Booking created successfully! Confirmation could be done through a call.');
        } else {
            // Hall not found, handle the error appropriately
            return back()->with('fail', 'Hall not found');
        }
    }
    
    public function showBookingForm()
    {
        $halls = Hall::all();
        $services = Service::all();
    
        return view('booking.bookform', compact('halls', 'services'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $books=Booking::all();
        return view('booking',compact('books'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Booking::with('hall', 'services')
            ->select('bookings.id', 'users.name as user_name', 'hall_lists.name as hall_name', 'bookings.event_schedule',  'bookings.total_guests', 'bookings.status','bookings.remarks', DB::raw('GROUP_CONCAT(services.name) as service_names'))
            ->join('users', 'users.id', '=', 'bookings.user_id')
            ->join('hall_lists', 'hall_lists.id', '=', 'bookings.hall_id')
            ->join('booking_service', 'booking_service.booking_id', '=', 'bookings.id')
            ->join('services', 'services.id', '=', 'booking_service.service_id')
            ->groupBy('bookings.id', 'hall_lists.name', 'bookings.event_schedule', 'bookings.total_guests', 'bookings.status', 'users.name','bookings.remarks')
            ->findOrFail($id);
    
        $services = Service::all(); // Replace 'Service' with your actual service model class name
    
        return view('editbooking', ['data' => $data, 'services' => $services]);
    }
    
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)

{
    $booking =  Booking::with('hall', 'services')
    ->select('bookings.id', 'users.name as user_name', 'hall_lists.name as hall_name', 'bookings.event_schedule', 'bookings.total_guests', 'bookings.status','bookings.remarks', DB::raw('GROUP_CONCAT(services.name) as service_names'))
    ->join('users', 'users.id', '=', 'bookings.user_id')
    ->join('hall_lists', 'hall_lists.id', '=', 'bookings.hall_id')
    ->join('booking_service', 'booking_service.booking_id', '=', 'bookings.id')
    ->join('services', 'services.id', '=', 'booking_service.service_id')
    ->groupBy('bookings.id', 'hall_lists.name',  'bookings.event_schedule', 'bookings.total_guests', 'bookings.status', 'users.name','bookings.remarks')
    ->findOrFail($request->id);

    // Validate the input
    $validatedData = $request->validate([
        'user_name' => 'required|string',
        'hall_name' => 'required|string',
        'services' => 'nullable|array',
        'event_schedule' => 'required|date_format:Y-m-d\TH:i',
        'total_guests' => 'required|integer',
        'remarks' => 'nullable|string',
        'status' => 'required|string',
        
    ]);

    // Update the booking data
    $booking->user_name = $validatedData['user_name'];
    $booking->hall_name = $validatedData['hall_name'];
    $booking->event_schedule = $validatedData['event_schedule'];
    
    $booking->total_guests = $validatedData['total_guests'];
    $booking->remarks = $validatedData['remarks'];
    $booking->status = $validatedData['status'];

    // Sync the services
    $booking->services()->sync($validatedData['services'] ?? []);

    // Save the changes
    $booking->save();

    // Redirect back to the booking details page or any other desired location
    return redirect()->route('booking.view', $booking->id)->with('success', 'Booking updated successfully');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteBooking($id)
    {
        $booking = Booking::find($id);
    
        if ($booking) {
            $booking->delete();
            return redirect('bookingView')->with('success', 'Booking deleted successfully.');
        } else {
            return redirect('bookingView')->with('fail', 'Booking not found.');
        }
    }
    public function booking(Request $request)
    {
        $data = [];
        if (Session::has('loginId')) {
            $result = Booking::with('hall', 'services')
            ->select('bookings.id', 'hall_lists.name as hall_name', 'bookings.event_schedule',  'bookings.total_guests', 'bookings.status','bookings.remarks',DB::raw('GROUP_CONCAT(services.name) as service_names'))
            ->join('users', 'users.id', '=', 'bookings.user_id')
            ->join('hall_lists', 'hall_lists.id', '=', 'bookings.hall_id')
            ->join('booking_service', 'booking_service.booking_id', '=', 'bookings.id')
            ->join('services', 'services.id', '=', 'booking_service.service_id')
            ->where('users.id', Session::get('loginId'))
            ->groupBy('bookings.id', 'hall_lists.name', 'bookings.event_schedule',  'bookings.total_guests','bookings.status','bookings.remarks')
            ->get();
            $data['result'] = $result;
            return view('booking.booking', $data);
        }  
        
    }
    public function bookingView(Request $request)
    {
        $data = [];
            $result = Booking::with('hall', 'services')
            ->select('bookings.id', 'users.name as user_name','hall_lists.name as hall_name', 'bookings.event_schedule','bookings.total_guests', 'bookings.status','bookings.remarks',DB::raw('GROUP_CONCAT(services.name) as service_names'))
            ->join('users', 'users.id', '=', 'bookings.user_id')
            ->join('hall_lists', 'hall_lists.id', '=', 'bookings.hall_id')
            ->join('booking_service', 'booking_service.booking_id', '=', 'bookings.id')
            ->join('services', 'services.id', '=', 'booking_service.service_id')
            ->groupBy('bookings.id', 'hall_lists.name', 'bookings.event_schedule', 'bookings.total_guests','bookings.status','users.name','bookings.remarks')
            ->get();
            $data['result'] = $result;
            return view('booking.bookingdetail', $data);
    }
   
    public function updateStatus(Request $request, $bookingId)
    {
        // Update the booking status to 'Confirmed'
        $booking = Booking::find($bookingId);
        $booking->status = 'Confirmed';
        $booking->save();
    
        // Check if the status is updated to 'Confirmed'
        if ($booking->status === 'Confirmed') {
            // Send confirmation email to the customer
          
    
            Mail::to($booking->user->email)->send(new BookingConfirmation($booking->user_name, $booking->hall_name, $booking->event_schedule, $booking->total_guests));
        }
    
        // Redirect or return response
    }


}