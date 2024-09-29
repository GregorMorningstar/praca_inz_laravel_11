@extends('admin.admin_dashboard')

@section('assign_car')
    <div class="page-content">
        <h1>Przypisz Samochód do Kierowcy</h1>

        <h3>Dane Kierowcy:</h3>
        <ul>
            <li>ID: {{ $driver->id }}</li>
            <li>Imię: {{ $driver->name }}</li>
            <li>Email: {{ $driver->email }}</li>
            <li>Telefon: {{ $driver->phone }}</li>
            <li>Adres: {{ $driver->address }}</li>
        </ul>

        <h3>Wybierz Samochód:</h3>
        <form action="#" method="POST">
            @csrf
            <label for="car_id">Wybierz samochód:</label>
            <select name="car_id" id="car_id" required>
                @foreach($activeCars as $car)
                    <option value="{{ $car->id }}">{{ $car->license_plate }}</option>
                @endforeach
            </select>
            <button type="submit">Przypisz samochód</button>
        </form>
    </div>
@endsection
