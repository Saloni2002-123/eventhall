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
        // Validate the form data
        $validatedData = $request->validate([
            'hall_id' => 'required',
           
            'services.*' => 'exists:services,id',
            'total_guests' => 'required|integer',
            'event_schedule' => 'required|date',
            'remarks' => 'nullable|string',
        ]);

        // Retrieve the user instance
        $user = User::find($userId);
        if ($user) {
            // Retrieve the hall instance
            $hall = Hall::find($validatedData['hall_id']);
            if ($hall) {
                // Retrieve the service instances
           
                // Create a new booking instance
                $booking = new Booking();
                $booking->user_id = $user->id;
                $booking->hall_id = $hall->id;
               
                $booking->total_guests = $validatedData['total_guests'];
                $booking->event_schedule = $validatedData['event_schedule'];
                $booking->remarks = $validatedData['remarks'];
          
                // Save the booking instance to the database
               $res= $booking->save();

                // Attach the services to the booking
          
                $booking->services()->attach($validatedData['services'], ['booking_id' => $booking->id]);
                if (!empty($validatedData['services'])) {
                    $booking->service_id = $validatedData['services'][0];
                    $booking->save();
                }
        
                return redirect()->route('booking.form', $booking->id)->with('success', 'Booking created successfully!');
            } else {
                // Hall not found, handle the error appropriately
                return back()->with('fail', 'Hall not found');
            }
        } else {
            // User not found, handle the error appropriately
            return back()->with('fail', 'User not found');
        }
        if($res)
        {
            return back()->with('success','Booking Done');
        }
        else{
            return back()->with('fail','Booking Failed');
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
            ->select('bookings.id', 'users.name as user_name', 'hall_lists.name as hall_name', 'bookings.event_schedule', 'bookings.total_guests', 'bookings.status', DB::raw('GROUP_CONCAT(services.name) as service_names'))
            ->join('users', 'users.id', '=', 'bookings.user_id')
            ->join('hall_lists', 'hall_lists.id', '=', 'bookings.hall_id')
            ->join('booking_service', 'booking_service.booking_id', '=', 'bookings.id')
            ->join('services', 'services.id', '=', 'booking_service.service_id')
            ->groupBy('bookings.id', 'hall_lists.name', 'bookings.event_schedule', 'bookings.total_guests', 'bookings.status', 'users.name')
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
    ->select('bookings.id', 'users.name as user_name', 'hall_lists.name as hall_name', 'bookings.event_schedule', 'bookings.total_guests', 'bookings.status', DB::raw('GROUP_CONCAT(services.name) as service_names'))
    ->join('users', 'users.id', '=', 'bookings.user_id')
    ->join('hall_lists', 'hall_lists.id', '=', 'bookings.hall_id')
    ->join('booking_service', 'booking_service.booking_id', '=', 'bookings.id')
    ->join('services', 'services.id', '=', 'booking_service.service_id')
    ->groupBy('bookings.id', 'hall_lists.name', 'bookings.event_schedule', 'bookings.total_guests', 'bookings.status', 'users.name')
    ->findOrFail($request->id);

    // Validate the input
    $validatedData = $request->validate([
        'user_name' => 'required|string',
        'hall_name' => 'required|string',
        'services' => 'nullable|array',
        'event_schedule' => 'required|date',
        'total_guests' => 'required|integer',
        'status' => 'required|string',
    ]);

    // Update the booking data
    $booking->user_name = $validatedData['user_name'];
    $booking->hall_name = $validatedData['hall_name'];
    $booking->event_schedule = $validatedData['event_schedule'];
    $booking->total_guests = $validatedData['total_guests'];
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
            ->select('bookings.id', 'hall_lists.name as hall_name', 'bookings.event_schedule', 'bookings.total_guests', 'bookings.status',DB::raw('GROUP_CONCAT(services.name) as service_names'))
            ->join('users', 'users.id', '=', 'bookings.user_id')
            ->join('hall_lists', 'hall_lists.id', '=', 'bookings.hall_id')
            ->join('booking_service', 'booking_service.booking_id', '=', 'bookings.id')
            ->join('services', 'services.id', '=', 'booking_service.service_id')
            ->where('users.id', Session::get('loginId'))
            ->groupBy('bookings.id', 'hall_lists.name', 'bookings.event_schedule', 'bookings.total_guests','bookings.status')
            ->get();
            $data['result'] = $result;
            return view('booking.booking', $data);
        }  
        
    }
    public function bookingView(Request $request)
    {
        $data = [];
            $result = Booking::with('hall', 'services')
            ->select('bookings.id', 'users.name as user_name','hall_lists.name as hall_name', 'bookings.event_schedule', 'bookings.total_guests', 'bookings.status',DB::raw('GROUP_CONCAT(services.name) as service_names'))
            ->join('users', 'users.id', '=', 'bookings.user_id')
            ->join('hall_lists', 'hall_lists.id', '=', 'bookings.hall_id')
            ->join('booking_service', 'booking_service.booking_id', '=', 'bookings.id')
            ->join('services', 'services.id', '=', 'booking_service.service_id')
            ->groupBy('bookings.id', 'hall_lists.name', 'bookings.event_schedule', 'bookings.total_guests','bookings.status','users.name')
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
