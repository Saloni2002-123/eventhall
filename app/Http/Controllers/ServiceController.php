<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Service;
class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getServices()
    {
        $services = DB::table('services')->select('name', 'description')->get();
        return $services;
    }
    public function viewServices()
{
    $services = $this->getServices();
    return view('service',compact('services'));
}
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $services=Service::all();
        return view('serve',compact('services'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data= Service::find($id);
        return view('editservice',['data'=>$data]);
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
           
   $data = Service::find($request->id);
   $data->name = $request->name;
   $data->description = $request->description;
   $data->status = $request->status; // Adjust the length as per your column definition
   $data->save();
   // Determine the CSS class based on the status
   $buttonClass = ($data->status == 'active') ? 'active-button' : 'inactive-button';
   return redirect('serve')->with('success', 'Service updated successfully')->with('buttonClass', $buttonClass);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function service()
    {
        $services=Service::all();
        return view('serve',compact('services'));
    }
    public function destroy($id)
    {
        //
    }
}
