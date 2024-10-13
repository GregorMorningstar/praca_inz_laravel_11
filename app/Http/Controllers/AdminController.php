<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Truck;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        $pendingOrdersCount = Order::where('status', 'pending')->count();
        $userCount = User::where('role', 'user')->count();
        $carCount = Truck::get()->count();
        $users = User::whereIn('role', ['driver', 'dispatcher'])->paginate(10);

//dd($pendingOrdersCount);
        return view('admin.index', compact('pendingOrdersCount','userCount','carCount','users'));
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
        //dd($drivers);
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
        // Pobierz kierowców wraz z ich przypisanymi samochodami
        $drivers = User::where('role', 'driver')->with('truck')->paginate(5);
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
    public function destroyUser($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return redirect()->route('users/list')->with('success', 'Konto użytkownika zostało usunięte.');
        } else {
            return redirect()->route('users/list')->with('error', 'Nie znaleziono użytkownika.');
        }
    }

    // Roles
    public function role_edit()
    {
        $user = User::paginate(5);
     //   dd($user);
        return view('admin.role_edit', compact('user'));
    }
    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Zaktualizuj rolę użytkownika
        $user->role = $request->role;
       // dd($user);
        $user->save();

        return redirect()->back()->with('success', 'Rola użytkownika '.$user->username.'została zaktualizowana na '.$user->role.' ');
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
