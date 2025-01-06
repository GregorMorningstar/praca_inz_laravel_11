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
                        <th>Akcje</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($driverTrucks as $order)
                        <tr>
                            <td>{{ $order->order->id }}</td>
                            <td>{{ $order->order->place_of_loading }}</td>
                            <td>{{ $order->order->loading_date ?? 'Brak daty rozładunku' }}</td>
                            <td>{{ $order->order->place_of_delivery }}</td>
                            <td>{{ $order->order->delivery_date ?? 'Brak daty rozładunku' }}</td>
                            <td>

                                @if (is_null($order->starting_mileage))
                                    <form action="{{ route('driver.order.in_progress_detal', ['id' => $order->id]) }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="ending_mileage">Wprowadź stan licznika:</label>
                                            <input type="number" name="start_mileage" id="start_mileage" placeholder="{{ $order->truck->mileage }}"
                                                   class="form-control" required>
                                        </div>
                                        <button class="btn btn-primary">Rozpoczęto jazdę</button>
                                    </form>
                                @elseif ($order->starting_mileage)
                                    <form action="{{ route('driver.order.in_progress_order_detal_finish', ['id' => $order->id]) }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="ending_mileage">Wprowadź końcowy stan licznika:</label>
                                            <input type="number" name="ending_mileage" id="ending_mileage" placeholder="{{ $order->truck->mileage }}"
                                                   class="form-control" required>
                                        </div>
                                        <button class="btn btn-success">Jazda zakończona</button>
                                    </form>
                                @endif

                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

@endsection
