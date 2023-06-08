<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Hall;

class HallController extends Controller
{

    public function getHalls()
{
       // specify the path to the image directory in your application
      
    $halls = DB::table('hall_lists')->select('name', 'description','image')->get();
    return $halls;
}

public function viewHalls()
{
    $halls = $this->getHalls();
    return view('main.event',compact('halls'));
}
public function show($id)
{
    //
    $halls=Hall::all();
    return view('hall',compact('events'));
}
public function edit($id)
{
    $data= Hall::find($id);
    return view('edithall',['data'=>$data]);
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
    
   $data = Hall::find($request->id);
$data->name = $request->name;
$data->description = $request->description;
$data->status = $request->status; 
$res=$data->save();
$buttonClass = ($data->status == 'active') ? 'active-button' : 'inactive-button';
if($res)
{
    return redirect('hall')->with('success', 'Hall updated successfully')->with('buttonClass', $buttonClass);
}
else{
    return redirect('hall')->with('fail', 'Hall updated failed')->with('buttonClass', $buttonClass);
}
// Determine the CSS class based on the status

// return redirect('hall')->with('success', 'Hall updated successfully')->with('buttonClass', $buttonClass);

}

/**
 * Remove the specified resource from storage.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
   public function hall()
    {
        $halls=Hall::all();
        return view('hall',compact('halls'));
    }
   
}
