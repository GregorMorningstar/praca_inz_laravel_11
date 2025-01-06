<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class UserController extends Controller
{
    public function UserDashboard(Request $request)
    {
        $place_of_loading = $request->input('place_of_loading');
        $loading_date = $request->input('loading_date');
        $place_of_delivery = $request->input('place_of_delivery');
        $delivery_date = $request->input('delivery_date');
        $username = $request->input('username');
        $status = $request->input('status');

        $query = Order::with('user');

        if ($place_of_loading) {
            $query->where('place_of_loading', 'like', '%' . $place_of_loading . '%');
        }

        if ($loading_date) {
            $query->whereDate('loading_date', '=', Carbon::parse($loading_date)->format('Y-m-d'));
        }

        if ($place_of_delivery) {
            $query->where('place_of_delivery', 'like', '%' . $place_of_delivery . '%');
        }

        if ($delivery_date) {
            $query->whereDate('delivery_date', '=', Carbon::parse($delivery_date)->format('Y-m-d'));
        }

        if ($username) {
            $query->whereHas('user', function ($query) use ($username) {
                $query->where('username', 'like', '%' . $username . '%');
            });
        }

        if ($status) {
            $query->where('status', $status);
        }

        $orders = $query->paginate(10);

        return view('user.index', compact('orders'));
    }

    public function UserLogOut(Request $request)
    {

        //dd($request);
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
    public function AddNewOrder(Request $request)
    {        // Walidacja danych wejściowych
        $validatedData = $request->validate([
            'place_of_loading' => 'required|string',
            'loading_date' => 'required|date',
            'place_of_delivery' => 'required|string',
            'delivery_date' => 'required|date',
            'cargo_weight' => 'required|numeric',
            'cargo_length' => 'required|numeric',
            'mileage' => 'required|integer',
            'cost' => 'required|numeric',
            'status' => 'nullable|in:pending,in_progress,canceled,completed', // Walidacja statusu
        ]);
        // Jeśli status nie jest podany, ustaw domyślną wartość
        $validatedData['status'] = $validatedData['status'] ?? 'pending';
        // Dodanie ID aktualnego użytkownika do danych
        $validatedData['user_id'] = auth()->id();
        // Utworzenie nowego zamówienia
        $order = Order::create($validatedData);

        return redirect()->route('user/dashboard')->with('success', 'Order added successfully!');

    }
    public function CreateNewOrder()
{
    return view('user.create_new_order');
}
    public function AllOrder(Request $request)
    {
        $place_of_loading = $request->input('place_of_loading');
        $loading_date = $request->input('loading_date');
        $place_of_delivery = $request->input('place_of_delivery');
        $delivery_date = $request->input('delivery_date');
        $cargo_weight = $request->input('cargo_weight');
        $status = $request->input('status');

        $query = Order::query();

        if ($place_of_loading) {
            $query->where('place_of_loading', 'like', '%' . $place_of_loading . '%');
        }

        // Filtracja po dacie załadunku
        if ($loading_date) {
            $query->whereDate('loading_date', '=', Carbon::parse($loading_date)->format('Y-m-d'));
        }

        if ($place_of_delivery) {
            $query->where('place_of_delivery', 'like', '%' . $place_of_delivery . '%');
        }

        if ($delivery_date) {
            $query->whereDate('delivery_date', '=', Carbon::parse($delivery_date)->format('Y-m-d'));
        }

        if ($cargo_weight) {
            $query->where('cargo_weight', '=', $cargo_weight);
        }

        if ($status) {
            $query->where('status', $status);
        }

        $orders = $query->paginate(5);
//dd($orders);
        return view('user.all_order', compact('orders'));
    }

    public function My_order(Request $request)
    {
        $place_of_loading = $request->input('place_of_loading');
        $loading_date = $request->input('loading_date');
        $place_of_delivery = $request->input('place_of_delivery');
        $delivery_date = $request->input('delivery_date');
        $cargo_weight = $request->input('cargo_weight');
        $status = $request->input('status');

        $query = Order::where('user_id', Auth::id());

        if ($place_of_loading) {
            $query->where('place_of_loading', 'like', '%' . $place_of_loading . '%');
        }

        if ($loading_date) {
            $query->whereDate('loading_date', '=', Carbon::parse($loading_date)->format('Y-m-d'));
        }

        if ($place_of_delivery) {
            $query->where('place_of_delivery', 'like', '%' . $place_of_delivery . '%');
        }

        if ($delivery_date) {
            $query->whereDate('delivery_date', '=', Carbon::parse($delivery_date)->format('Y-m-d'));
        }

        if ($cargo_weight) {
            $query->where('cargo_weight', '=', $cargo_weight);
        }

        if ($status) {
            $query->where('status', $status);
        }

        $orders = $query->paginate(5);

        return view('user.user_order', compact('orders'));
    }

    public function completedOrders(Request $request)
    {
        $place_of_loading = $request->input('place_of_loading');
        $loading_date = $request->input('loading_date');
        $place_of_delivery = $request->input('place_of_delivery');
        $delivery_date = $request->input('delivery_date');
        $cargo_weight = $request->input('cargo_weight');
        $status = $request->input('status');

        $query = Order::where('user_id', Auth::id())
            ->where('status', 'completed');

        if ($place_of_loading) {
            $query->where('place_of_loading', 'like', '%' . $place_of_loading . '%');
        }

        if ($loading_date) {
            $query->whereDate('loading_date', '=', Carbon::parse($loading_date)->format('Y-m-d'));
        }

        if ($place_of_delivery) {
            $query->where('place_of_delivery', 'like', '%' . $place_of_delivery . '%');
        }

        if ($delivery_date) {
            $query->whereDate('delivery_date', '=', Carbon::parse($delivery_date)->format('Y-m-d'));
        }

        if ($cargo_weight) {
            $query->where('cargo_weight', '=', $cargo_weight);
        }

        if ($status) {
            $query->where('status', $status);
        }

        $completedOrders = $query->paginate(10);

        return view('user.completed_orders', compact('completedOrders'));
    }

    public function in_progresOrders(Request $request)
    {
        $place_of_loading = $request->input('place_of_loading');
        $loading_date = $request->input('loading_date');
        $place_of_delivery = $request->input('place_of_delivery');
        $delivery_date = $request->input('delivery_date');
        $cargo_weight = $request->input('cargo_weight');
        $status = $request->input('status');

        $query = Order::where('user_id', Auth::id())
            ->where('status', 'in_progress');

        if ($place_of_loading) {
            $query->where('place_of_loading', 'like', '%' . $place_of_loading . '%');
        }

        if ($loading_date) {
            $query->whereDate('loading_date', '=', Carbon::parse($loading_date)->format('Y-m-d'));
        }

        if ($place_of_delivery) {
            $query->where('place_of_delivery', 'like', '%' . $place_of_delivery . '%');
        }

        if ($delivery_date) {
            $query->whereDate('delivery_date', '=', Carbon::parse($delivery_date)->format('Y-m-d'));
        }

        if ($cargo_weight) {
            $query->where('cargo_weight', '=', $cargo_weight);
        }

        if ($status) {
            $query->where('status', $status);
        }

        $in_progresOrders = $query->paginate(10);

        return view('user.in_progress_orders', compact('in_progresOrders'));
    }


    public function UserCalendar()
    {
        $orders = Order::where('user_id', Auth::id())->get();

        return view('user.user_calendar',compact('orders'));
    }
}
