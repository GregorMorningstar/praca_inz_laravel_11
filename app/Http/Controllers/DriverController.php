<?php

namespace App\Http\Controllers;

use App\Models\DriverTruck;
use App\Models\Order;
use App\Models\Truck;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{
  public function DriverDashboard()
  {

      $id = Auth::getUser();
      $user = User::with('truck',)->findOrFail($id->id); // zakładając, że istnieje relacja truck w modelu User

      $driverTrucks = DriverTruck::whereNull('starting_mileage')
          ->with('order','user','truck')
      ->where('truck_id', $user->id) // Filtruj po id kierowcy
      ->get();
//dd($driverTrucks);
      return view('driver.index', compact('user','driverTrucks'));
  }
    public function DriverLogOut(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
    public function GetOrderByDriver($id)
    {

        $truckId = Auth::id();
        $driverTrucks = DriverTruck::where('truck_id', $truckId)
            ->with('order','user','truck')
            ->where('order_id', $id)
            ->firstOrFail();
//dd($driverTrucks->order);
        return view('driver.get_order_by_driver',compact('driverTrucks'));
  }

    public function AcceptOrder($id, Request $request){


        $currentOrder = DriverTruck::with(['order', 'user', 'truck'])->findOrFail($id);
        $currentOrder->started_driving_at = now();
        $currentOrder->starting_mileage = $currentOrder->truck->mileage;
        $currentOrder->save();

        return redirect()->route('driver/dashboard')->with('success',
            'Rozpoczęto jazdę zlecenia '.$currentOrder->order->place_of_loading.' do: '.$currentOrder->order->place_of_delivery.'.');


    }

    public function InProgressOrder()
    {
        $truckId = Auth::id();

        $driverTrucks = DriverTruck::where('truck_id', $truckId)
            ->whereNotNull('started_driving_at')
            ->whereNull('ended_driving_at')
            ->with('order', 'user', 'truck')
            ->get();
//dd($driverTrucks);

        return view('driver.inProgress',compact('driverTrucks'));
}

    public function InProgressOrderDetal($id, Request $request)
    {

        $startMileage = $request->input('start_mileage');
        $currentOrder = DriverTruck::where('id', $id)
            ->with('order', 'user', 'truck')
            ->firstOrFail();
        $validatedData = $request->validate([
            'start_mileage' => 'required|numeric|min:0',
        ]);
        if ($startMileage < 0 || $validatedData['start_mileage'] < $currentOrder->truck->mileage) {
            return redirect()->back()->with('error', 'Kilometry muszą być większe od 0 i nie mogą być mniejsze niż stan licznika.');
        }
        $currentOrder->started_driving_at = now();
        $currentOrder->starting_mileage = $validatedData['start_mileage'];
        $currentOrder->save();

        $truck = Truck::findOrFail($currentOrder->truck->id);
        $truck->mileage = $validatedData['start_mileage'];
        $truck->save();



        return redirect()->back()->with('success', 'Zlecenie ukończone.');
}
    public function InProgressOrderDetalFinish($id, Request $request)
    {
        $endingMileage = $request->input('ending_mileage');
        $currentOrder = DriverTruck::where('id', $id)
            ->with('order', 'user', 'truck')
            ->firstOrFail();
        $validatedData = $request->validate([
            'ending_mileage' => 'required|numeric|min:0',
        ]);
        if ($endingMileage < 0 || $validatedData['ending_mileage'] < $currentOrder->truck->mileage) {
            return redirect()->back()->with('error', 'Kilometry muszą być większe od 0 i nie mogą być mniejsze niż stan licznika.');
        }
        $currentOrder->ended_driving_at = now();
        $currentOrder->ending_mileage = $validatedData['ending_mileage'];
        $currentOrder->save();

        $truck = Truck::findOrFail($currentOrder->truck->id);
        $truck->mileage = $validatedData['ending_mileage'];
        $truck->save();



        return redirect()->back()->with('success', 'Zlecenie ukończone.');

        $truck = Truck::findOrFail($currentOrder->truck->id);
        $truck->mileage = $validatedData['ending_mileage'];
        $truck->save();
        $orderID = $currentOrder->order->id;
        $userOrder = Order::findOrFail($orderID);
        $userOrder->status = 'completed';
        $userOrder->save();


        return redirect()->back()->with('success', 'Zlecenie ukończone.');
    }

    public function HistoryDriverOrder()
    {
        $truckId = Auth::id();
        $driverTrucks = DriverTruck::where('truck_id', $truckId)
            ->whereHas('order', function($query) {
                $query->where('status', 'completed');
            })
            ->with('user','truck','order')
            ->get();

        //dd($driverTrucks);
        return view('driver.history',compact('driverTrucks'));
}
}
