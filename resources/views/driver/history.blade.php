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

        <div class="col-12 mb-4">
            <h1 class="text-primary text-center">Wykonane zlecenia</h1>
            <!-- Paginacja -->
            <div class="d-flex justify-content-center">
                {{ $driverTrucks->links('vendor.pagination.bootstrap-4', ['class' => 'pagination pagination-sm']) }}
            </div>
            <!-- Filtracja -->
            <form method="GET" action="{{ route('driver.order.history') }}">
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" name="place_of_loading" class="form-control" placeholder="Miejsce załadunku" value="{{ request('place_of_loading') }}">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="place_of_delivery" class="form-control" placeholder="Miejsce dostawy" value="{{ request('place_of_delivery') }}">
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="delivery_date" class="form-control" value="{{ request('delivery_date') }}">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Filtruj</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-12">
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
                            <td>{{ ($order->ending_mileage) -  ($order->starting_mileage) . ' KM'}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>


            @endif
        </div>
    </div>
@endsection
