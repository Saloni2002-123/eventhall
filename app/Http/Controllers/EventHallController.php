<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventHallController extends Controller
{
    function index()
    {
        return view('home');
    }
    function aboutus()
    {
        return view('about');
    }
  
    function eventhall()
    {
        return view('event');
    }
 
}
