<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DriverController extends Controller
{
  public function DriverDashboard()
  {
      return view('driver.index');
  }
}
