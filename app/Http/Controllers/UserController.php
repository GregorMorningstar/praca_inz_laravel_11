<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function UserDashboard()
    {
        $orders = Order::with('user')->get();
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
        return view('user.index');
}
}
