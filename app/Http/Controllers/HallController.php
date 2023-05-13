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
    return view('event',compact('halls'));
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
    $data=Hall::find($request->id);
    if (!$data) {
        return redirect('hall')->with('fail', 'Hall not found');
    }
    $data->name=$request->name;
    $data->description=$request->description;
    $data->status = $request->input('status');
    $data->save();
    return redirect('hall')->with('success', 'Hall updated successfully');

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
