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
            ->whereNull('ending_mileage')
            ->with('order', 'user', 'truck')
            ->get();
//dd($driverTrucks);

        return view('driver.inProgress',compact('driverTrucks'));
}

    public function InProgressOrderDetal($id, Request $request)
    {
        $orderId = $request->input('order_id');

        $currentOrder = DriverTruck::where('id', $orderId)
            ->with('order', 'user', 'truck')
            ->firstOrFail();

        $validatedData = $request->validate([
            'mileage' => 'required|numeric|min:0',
        ]);

        $distans = $request->input('mileage');
        if ($distans < 0 || $validatedData['mileage'] < $currentOrder->truck->mileage) {
            return redirect()->back()->with('error', 'Kilometry muszą być większe od 0 i nie mogą być mniejsze niż stan licznika.');
        }
        $currentOrder->ended_driving_at = now();
        $currentOrder->ending_mileage = $validatedData['mileage'];
       // dd($currentOrder);
        $currentOrder->save();

        $orderID = $currentOrder->order->id;
        $userOrder = Order::findOrFail($orderID);
        $userOrder->status = 'completed';
        $userOrder->save();

        $truck = Truck::findOrFail($currentOrder->truck->id);
        $truck->mileage = $validatedData['mileage'];
        $truck->save();
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
       // dd($driverTrucks);
        return view('driver.history',compact('driverTrucks'));
}
}
