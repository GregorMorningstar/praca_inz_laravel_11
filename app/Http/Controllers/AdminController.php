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
        //dd($request);
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

//metody z samochodami
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

//metody z spedytorami
    public function dispatcher_list()
    {
        return view('admin.dispatcher_list');
    }
    //metody z kierowcami
    public function driver_list()
    {
        $drivers = User::where('role', 'driver')->get();
        return view('admin.driver_list',compact('drivers'));
    }
    //role
    public function role_edit()
    {
        return view('admin.role_edit');

    }
    public function assignTruck(Request $request, $userId)
    {
        $truck = Truck::findOrFail($request->truck_id);

        // Dodaj nowy rekord w tabeli łączącej
        $user = User::findOrFail($userId);
        $user->trucks()->attach($truck->id, [
            'started_driving_at' => $request->started_driving_at,
            'ending_mileage' => null, // Możesz ustawić to później
            'fuel_consumed' => $request->fuel_consumed,
            'starting_mileage' => $truck->mileage, // Przebieg na start z modelu Truck
        ]);

        return redirect()->route('drivers.index')->with('success', 'Truck assigned successfully.');
    }

}

