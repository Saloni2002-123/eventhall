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
                $booking->save();

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
    }
    public function showBookingForm()
    {
        $halls = Hall::all();
        $services = Service::all();
    
        return view('bookform', compact('halls', 'services'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
            return view('booking', $data);
        }  
        
    }
}
