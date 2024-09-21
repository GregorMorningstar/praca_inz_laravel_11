<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function UserDashboard()
    {
        // Retrieve all orders with the associated user
        $orders = Order::with('user')->get();
        // Pass the orders to the view
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
    {
        // Walidacja danych wejściowych
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

    public function AllOrder()
    {
        // Pobieramy wszystkie zlecenia
        $orders = Order::paginate(1);
//dd($orders);
        // Przekazujemy zmienną 'orders' do widoku
        return view('user.all_order', compact('orders'));
    }
    public function My_order()
    {
        $orders = Order::where('user_id', Auth::id())->get();

        return view('user.user_order', compact('orders'));
    }


    public function completedOrders()
    {
        $completedOrders = Order::where('user_id', Auth::id())
            ->where('status', 'completed')
            ->paginate(10); // Liczba wyników na stronę

        return view('user.completed_orders', compact('completedOrders'));
    }
    public function in_progresOrders()
    {
        $in_progresOrders = Order::where('user_id', Auth::id())
            ->where('status', 'in_progress')
            ->paginate(10); // Liczba wyników na stronę
        return view('user.in_progress_orders', compact('in_progresOrders'));
    }

}
