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
            <h1 class="text-primary text-center">Aktywne zlecenia</h1>

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
                        <th>Rozpoczecie dostawy</th>
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
                            <td>{{  $order->started_driving_at }}</td>
                            <td>
                                <form action="{{ route('driver.order.in_progress_detal', ['id' => $order->id]) }}" method="POST">
                                    @csrf
                                    <div class="form-group mr-2 text-center">
                                        <input type="hidden" name="order_id" value="{{ $order->id }}">

                                        <label for="mileage" class="sr-only">Stan Licznika:</label>
                                        <input type="number" name="mileage" id="mileage" class="form-control" placeholder="Kilometry" required>
                                    </div>
                                    <button type="submit" class="btn btn-info btn-sm align-center">
                                        <i class="fas fa-truck"></i>
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

@endsection
