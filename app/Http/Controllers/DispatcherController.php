<?php

namespace App\Http\Controllers;

use App\Models\DriverTruck;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DispatcherController extends Controller
{


    public function DispatcherDashboard()
    {
        $order = Order::where('status', 'pending')
            ->orderBy('loading_date', 'desc') // Sortowanie od najnowszych do najstarszych
            ->get();
        //dd($order);
        return view('dispatcher.index', compact('order'));
    }

    public function AssingOrder($id)
    {
        $actualyOrder = Order::with('user')->findOrFail($id);
        $drivers = User::where('role', 'driver')->whereHas('truck')->get(); // zakładając, że relacja nazywa się 'truck'

        return view('dispatcher.assing_order', compact('actualyOrder','drivers'));
    }

    public function OrderCancel($id)
    {

        $cancelOrder = Order::findOrFail($id);
        $cancelOrder->status = 'canceled';
        $cancelOrder->save();
        return redirect()->back()->with('success', 'Zlecenie   z '
            .$cancelOrder->place_of_loading.
            ' do  '
            .$cancelOrder->place_of_delivery.
            ' zostalo anulowane'

        );


    }

    public function AddingOrderToDriver($id, Request $request)
    {
        // Walidacja danych z requestu
        $validator = Validator::make($request->all(), [
            'driver_id' => 'required|exists:users,id', // Sprawdza, czy driver_id istnieje w tabeli users
            'user_id'   => 'required|exists:users,id', // Sprawdza, czy user_id istnieje w tabeli users
        ]);

        // Sprawdź, czy walidacja się powiodła
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Pobranie danych
        $order_id = $id;
        $id_driver = $request->input('driver_id');
        $user_id = $request->input('user_id');

        // Tworzenie nowego rekordu w tabeli driver_truck
        $driver_order = new DriverTruck();
        $driver_order->user_id = $user_id; // Zleceniodawca
        $driver_order->truck_id = $id_driver; // Kierowca przypisany do ciężarówki
        $driver_order->order_id = $order_id; // Zlecenie
        $driver_order->started_driving_at = null;
        $driver_order->ended_driving_at = null;
        $driver_order->starting_mileage = null;
        $driver_order->ending_mileage = null;
        $driver_order->fuel_consumed = null;
     //
        $driver_order->save();

        //zmiana statusu
        $order = Order::findOrFail($order_id);
        $order->status = 'in_progress';
        $order->save();

        // Zwróć odpowiedź po zapisaniu do bazy
        return redirect()->route('dispatcher/dashboard')->with('success', 'Przypisano kierowce');
    }

    public function activeOrder()
    {
        $activeOrder = Order::where('status','in_progress')->paginate(10);


return view('dispatcher.active_order',compact('activeOrder'));
    }

    public function canceledOrder()
    {
        $canceledOrder = Order::where('status','canceled')->paginate(10);


        return view('dispatcher.canceled_assing',compact('canceledOrder'));

    }

    public function changeInProgres($id)
    {
        $changeOrderStatus = Order::findOrFail($id);
        $changeOrderStatus->status = 'in_progress';
        $changeOrderStatus->save();

        //dd($changeOrderStatus);
        return redirect()->route('spedytor/order/active')->with('success', 'Przyjęto do realizacji wycofany kurs o id . '.$changeOrderStatus->id );

    }
    public function historyOrder()
    {
  $historyOrder = Order::where('status','completed')->paginate(10);
        return view('dispatcher.history_order',compact('historyOrder'));

    }
}
