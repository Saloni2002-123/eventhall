<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventHallController extends Controller
{
    function index()
    {
        return view('main.home');
    }
    function aboutus()
    {
        return view('main.about');
    }
  
    function eventhall()
    {
        return view('main.event');
    }
 
}
