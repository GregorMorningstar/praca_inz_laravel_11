<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DispatcherController extends Controller
{


    public function DispatcherDashboard()
    {
        return view('dispatcher.index');
    }
}
