@extends('driver.driver_dashboard')
@section('driver')
    <div class="container mt-7">
        <h1 class="text-center">Panel Kierowcy</h1>

        <div class="row text-center">
            <!-- Div zajmujący 33% wysokości -->
            <div class="col-12" style="height: 33vh; overflow-y: auto;">
                <div class="mt-9">
                    <h4>Dane użytkownika</h4>
                    <ul class="list-unstyled">
                        <li><strong>Imię:</strong> {{ $user->name }}</li>
                        <li><strong>Email:</strong> {{ $user->email }}</li>
                        <li><strong>Telefon:</strong> {{ $user->phone }}</li> <!-- Zakładając, że jest pole 'phone' w modelu User -->
                    </ul>
                </div>
                <span >Przypisany samochód</span>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Numer rejestracyjny</th>
                        <th>Przebieg (km)</th>
                        <th>Marka</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $user->truck->license_plate }}</td>
                        <td>{{ $user->truck->mileage }}</td>
                        <td>{{ $user->truck->brand }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>



        </div>
        <div class="col-12 ">
            <h1 class="text-primary text-center">Aktywne zlecenia</h1>
            <h4>Zlecenia użytkownika</h4>
            @if ($driverTrucks->isEmpty())
                <p>Brak zleceń dla tego użytkownika.</p>
            @else
                <table class="table table-responsive-sm">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Miejsce załadunku</th>
                        <th>Data załadunku</th>
                        <th>Miejsce dostawy</th>
                        <th>Data dostawy</th>
                        <th>Akcje</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($driverTrucks as $order)
                        <tr>
                            <td>{{ $order->order->id }}</td>
                            <td>{{ $order->order->place_of_loading }}</td>
                            <td>{{ $order->order->loading_date->format('Y-m-d') }}</td>
                            <td>{{ $order->order->place_of_delivery }}</td>
                            <td>{{ $order->order->delivery_date->format('Y-m-d') }}</td>
                            <td>
                                <form action="{{ route('driver/order/{id}/get', ['id' => $order->order->id]) }}" method="GET">
                                    @csrf
                                    <button type="submit" class="btn btn-info btn-sm">
                                        <i class="fas fa-info"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        </div>
    </div>
@endsection
