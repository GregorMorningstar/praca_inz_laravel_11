@extends('driver.driver_dashboard')
@section('driver')
    <div class="container p-6-7">

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="text-center">Szczegóły zlecenia z {{ $driverTrucks->order->place_of_loading }} do {{ $driverTrucks->order->place_of_delivery }}</h1>

        <div class="m-4">
            <h3>Informacje o zleceniu</h3>
            <p><strong>Miejsce załadunku:</strong> {{ $driverTrucks->order->place_of_loading }}</p>
            <p><strong>Data załadunku:</strong> {{ \Carbon\Carbon::parse($driverTrucks->order->loading_date)->format('Y-m-d') }}</p>
            <p><strong>Miejsce dostawy:</strong> {{ $driverTrucks->order->place_of_delivery }}</p>
            <p><strong>Data dostawy (zakończenia):</strong> {{ \Carbon\Carbon::parse($driverTrucks->order->delivery_date)->format('Y-m-d') }}</p>
            <p><strong>Ilość Kilometrów:</strong> {{ $driverTrucks->order->mileage }}</p>
            <p><strong>Waga:</strong> {{ $driverTrucks->order->cargo_weight }} kg.</p>
            <p><strong>Koszt:</strong> {{ $driverTrucks->order->cost }} PLN</p>

            <br/>

            <p>Zlecenie wystawione przez: {{ $driverTrucks->user->username }}</p>
        </div>

        <form action="{{ route('driver.order.accept', ['id' => $driverTrucks->id]) }}" method="POST">
            @csrf
            <div class="form-group align-items-center">
                <input type="hidden" name="mileage" value="{{ $driverTrucks->truck->mileage }}">
            </div>
            <button type="submit" class="btn btn-success btn-sm">
                <i class="fas fa-check"></i> Akceptuj zlecenie
            </button>
        </form>

    </div>
@endsection
