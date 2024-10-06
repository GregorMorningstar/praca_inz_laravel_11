@extends('dispatcher.dispatcher_dashboard')
@section('dispatcher')
    <div class="page-content">
        <h4 class="text-center">Szczegóły zlecenia</h4>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="order-details">
            <h5>ID Zlecenia: {{ $actualyOrder->id }}</h5>
            <p><strong>Miejsce załadunku:</strong> {{ $actualyOrder->place_of_loading }}</p>
            <p><strong>Data załadunku:</strong> {{ $actualyOrder->loading_date->format('d-m-Y') }}</p>
            <p><strong>Miejsce dostawy:</strong> {{ $actualyOrder->place_of_delivery }}</p>
            <p><strong>Data dostawy:</strong> {{ $actualyOrder->delivery_date->format('d-m-Y') }}</p>
            <p><strong>Waga towaru:</strong> {{ $actualyOrder->cargo_weight }} kg</p>
            <p><strong>Długość towaru:</strong> {{ $actualyOrder->cargo_length }} m</p>
            <p><strong>Ilość kilometrów:</strong> {{ $actualyOrder->mileage }}</p>
            <p><strong>Koszt:</strong> {{ $actualyOrder->cost }} PLN</p>
            <p><strong>Status:</strong> {{ ucfirst($actualyOrder->status) }}</p>
            <p><strong>Użytkownik, który wystawił zlecenie:</strong> {{ $actualyOrder->user->name }} ({{ $actualyOrder->user->email }})</p>
        </div>

        <div class="assign-driver mt-4">
            <h5>Przydziel kierowcę</h5>
            <form action="{{  route('order/driver/assing', $actualyOrder->id) }}" method="GET">
                @csrf
                <!-- Pole hidden do przekazania user_id -->
                <input type="hidden" name="user_id" value="{{ $actualyOrder->user->id }}">

                <div class="form-group">

                    <label for="driver">Wybierz kierowcę:</label>
                    <select name="driver_id" id="driver" class="form-control">
                        <option value="">-- Wybierz kierowcę --</option>
                        @foreach($drivers as $driver)
                            <option value="{{ $driver->id }}">{{ $driver->username }} | <strong>NR rej:  </strong>{{$driver->truck->license_plate}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Przydziel kierowcę</button>
            </form>
        </div>
    </div>
@endsection
