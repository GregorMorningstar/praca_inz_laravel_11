<?php

namespace App\Http\Controllers;

use App\Models\Truck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        return view('admin.index');
    }

    public function AdminLogOut(Request $request)
    {

        //dd($request);
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function AdminLogin(Request $request)
    {
        return view('admin.admin_login');
    }
public function AdminAddCar()
{
    return view('admin.add_car');
}

public function AdminListCar()
{
    $trucks = Truck::with('driver')->get(); // Pobiera wszystkie ciężarówki z przypisanymi kierowcami
    return view('admin.car_list', compact('trucks'));

}
public function AdminAddCarToDriver()
{
    return view('admin.add_car_to_driver');
}


public function CarStore(Request $request)
{
    $request->validate([
        'license_plate' => 'required|unique:trucks,license_plate',
        'production_year' => 'required|string',
        'brand' => 'required|string',
        'mileage' => 'required|integer',
        'color' => 'required|string',
        'length' => 'required|numeric',
        'height' => 'required|numeric',
        'vin' => 'required|size:17|unique:trucks,vin',
        'driver_id' => 'nullable|exists:users,id'
    ]);


    // Zapis samochodu w bazie
    Truck::create($request->all());

    return redirect()->route('car/list')->with('success', 'Truck added successfully');
}


}
