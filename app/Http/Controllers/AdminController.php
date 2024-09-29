<?php

namespace App\Http\Controllers;

use App\Models\Truck;
use App\Models\User;
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
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // Methods related to cars
    public function AdminAddCar()
    {
        return view('admin.add_car');
    }

    public function AdminListCar()
    {
        $trucks = Truck::with('driver')->paginate(5);
        return view('admin.car_list', compact('trucks'));
    }

    public function AdminAddCarToDriver()
    {
        $drivers = User::where('role', 'driver')->with('truck')->paginate(10);
        $allTrucks = Truck::all();
        return view('admin.add_car_to_driver', compact('drivers', 'allTrucks'));
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

        Truck::create($request->all());

        return redirect()->route('car/list')->with('success', 'Truck added successfully');
    }

    // Methods related to dispatchers
    public function dispatcher_list()
    {
        $dispatchers = User::where('role', 'dispatcher')->paginate(5);
        return view('admin.dispatcher_list', compact('dispatchers'));
    }

    // Methods related to drivers
    public function driver_list()
    {
        $drivers = User::where('role', 'driver')->paginate(5);
        return view('admin.driver_list', compact('drivers'));
    }

    public function carAssing($id)
    {
        $driver = User::findOrFail($id);
        $activeCars = Truck::where('status', 'inactive')->get();
               return view('admin.assing_car', compact('driver', 'activeCars'));
    }

    public function storeCar(Request $request, $id)
    {
        $request->validate([
            'car_id' => 'required|exists:trucks,id',
        ]);

        $driver = User::findOrFail($id);
        $truck = Truck::findOrFail($request->car_id); // Use findOrFail for better error handling
        $truck->status = 'active';
        $truck->driver_id = $driver->id;
        $truck->save();

        return redirect()->route('car/list')->with('success', 'Samochód został przypisany do kierowcy.');
    }

    // Methods related to users
    public function user_list()
    {
        $users = User::where('role', 'user')->paginate(5);
        return view('admin.user_list', compact('users'));
    }

    // Roles
    public function role_edit()
    {
        return view('admin.role_edit');
    }

    public function carRemove(Request $request, $carId)
    {
        // Find the truck by ID
        $truck = Truck::findOrFail($carId);

        // Update the truck's status and driver ID
        $truck->status = 'inactive';
        $truck->driver_id = null;
        $truck->save(); // Save changes to the database
        // Redirect with success message
        return redirect()->route('car/list')->with('success', 'Samochód został usunięty z kierowcy.');
    }

}
