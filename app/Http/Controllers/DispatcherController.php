<?php

namespace App\Http\Controllers;

use App\Models\DriverTruck;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class DispatcherController extends Controller
{
    public function DispatcherLogOut(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function DispatcherDashboard()
    {
        $order = Order::where('status', 'pending')
            ->orderBy('loading_date', 'desc')
            ->get();
        //dd($order);
        return view('dispatcher.index', compact('order'));
    }

    public function AssingOrder($id)
    {
        $actualyOrder = Order::with('user')->findOrFail($id);
        $drivers = User::where('role', 'driver')->whereHas('truck')->get(); // zakładając, że relacja nazywa się 'truck'
        return view('dispatcher.assing_order', compact('actualyOrder', 'drivers'));
    }

    public function OrderCancel($id)
    {
        $cancelOrder = Order::findOrFail($id);
        $cancelOrder->status = 'canceled';
        $cancelOrder->save();
        return redirect()->back()->with('success', 'Zlecenie   z '
            . $cancelOrder->place_of_loading .
            ' do  '
            . $cancelOrder->place_of_delivery .
            ' zostalo anulowane'

        );


    }

    public function AddingOrderToDriver($id, Request $request)
    {
        // Walidacja danych z requestu
        $validator = Validator::make($request->all(), [
            'driver_id' => 'required|exists:users,id', // Sprawdza, czy driver_id istnieje w tabeli users
            'user_id' => 'required|exists:users,id', // Sprawdza, czy user_id istnieje w tabeli users
        ]);

        // Sprawdź, czy walidacja się powiodła
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Pobranie danych
        $order_id = $id;
        $id_driver = $request->input('driver_id');
        $user_id = $request->input('user_id');

        // Sprawdź, czy rekord już istnieje
        $existingRecord = DriverTruck::where('user_id', $user_id)
            ->where('truck_id', $id_driver)
            ->where('order_id', $order_id)
            ->exists();

        if ($existingRecord) {
            return redirect()->back()->withErrors(['error' => 'Rekord już istnieje dla tego użytkownika, kierowcy i zlecenia.']);
        }

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

    public function activeOrder(Request $request)
    {
        $query = Order::where('status', 'in_progress');

        if ($request->has('place_of_loading') && $request->input('place_of_loading') != '') {
            $query->where('place_of_loading', 'like', '%' . $request->input('place_of_loading') . '%');
        }

        if ($request->has('place_of_delivery') && $request->input('place_of_delivery') != '') {
            $query->where('place_of_delivery', 'like', '%' . $request->input('place_of_delivery') . '%');
        }

        if ($request->has('cargo_weight') && $request->input('cargo_weight') != '') {
            $query->where('cargo_weight', 'like', '%' . $request->input('cargo_weight') . '%');
        }

        if ($request->has('cargo_length') && $request->input('cargo_length') != '') {
            $query->where('cargo_length', 'like', '%' . $request->input('cargo_length') . '%');
        }

        if ($request->has('mileage') && $request->input('mileage') != '') {
            $query->where('mileage', 'like', '%' . $request->input('mileage') . '%');
        }

        if ($request->has('start_date') && $request->input('start_date') != '') {
            $query->whereDate('loading_date', '>=', $request->input('start_date'));
        }

        if ($request->has('end_date') && $request->input('end_date') != '') {
            $query->whereDate('loading_date', '<=', $request->input('end_date'));
        }

        $activeOrder = $query->paginate(10);

        return view('dispatcher.active_order', compact('activeOrder'));
    }

    public function canceledOrder(Request $request)
    {
        $place_of_loading = $request->input('place_of_loading');
        $place_of_delivery = $request->input('place_of_delivery');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $query = Order::where('status', 'canceled');

        if ($place_of_loading) {
            $query->where('place_of_loading', 'like', '%' . $place_of_loading . '%');
        }

        if ($place_of_delivery) {
            $query->where('place_of_delivery', 'like', '%' . $place_of_delivery . '%');
        }

        if ($start_date) {
            $query->whereDate('loading_date', '>=', Carbon::parse($start_date)->format('Y-m-d'));
        }

        if ($end_date) {
            $query->whereDate('delivery_date', '<=', Carbon::parse($end_date)->format('Y-m-d'));
        }

        $canceledOrder = $query->paginate(10);

        return view('dispatcher.canceled_assing', compact('canceledOrder'));
    }

    public function changeInProgres($id)
    {
        $changeOrderStatus = Order::findOrFail($id);
        $changeOrderStatus->status = 'in_progress';
        $changeOrderStatus->save();

        //dd($changeOrderStatus);
        return redirect()->route('spedytor/order/active')->with('success', 'Przyjęto do realizacji wycofany kurs o id . ' . $changeOrderStatus->id);

    }

    public function historyOrder(Request $request)
    {
        $place_of_loading = $request->input('place_of_loading');
        $place_of_delivery = $request->input('place_of_delivery');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $query = Order::where('status', 'completed');

        if ($place_of_loading) {
            $query->where('place_of_loading', 'like', '%' . $place_of_loading . '%');
        }

        if ($place_of_delivery) {
            $query->where('place_of_delivery', 'like', '%' . $place_of_delivery . '%');
        }

        if ($start_date) {
            $query->whereDate('loading_date', '>=', Carbon::parse($start_date)->format('Y-m-d'));
        }

        if ($end_date) {
            $query->whereDate('delivery_date', '<=', Carbon::parse($end_date)->format('Y-m-d'));
        }

        $historyOrder = $query->paginate(10);

        return view('dispatcher.history_order', compact('historyOrder'));
    }

}
