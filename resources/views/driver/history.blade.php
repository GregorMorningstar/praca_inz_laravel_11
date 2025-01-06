@extends('driver.driver_dashboard')
@section('driver')
    <div class="container mt-7">
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
        <div class="col-12 ">
            <h1 class="text-primary text-center">Wykonane zlecenia</h1>

            @if ($driverTrucks->isEmpty())
                <p>Brak wykonanych zleceń dla tego użytkownika.</p>
            @else
                <table class="table table-responsive-sm">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Miejsce załadunku</th>
                        <th>Miejsce dostawy</th>
                        <th>Data Dostawy</th>
                        <th>Ilość kilometrów</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($driverTrucks as $order)
                        <tr>
                            <td>{{ $order->order->id }}</td>
                            <td>{{ $order->order->place_of_loading }}</td>
                            <td>{{ $order->order->place_of_delivery }}</td>
                            <td>{{ $order->ended_driving_at ? \Carbon\Carbon::parse($order->ended_driving_at)->format('Y-m-d') : 'Brak danych' }}</td>
                            <td>{{ ($order->ending_mileage) -  ($order->starting_mileage) . '  KM'}}</td>


                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

@endsection
