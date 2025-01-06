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
            <h1 class="text-primary text-center">Aktywne zlecenia</h1>
            <!-- Paginacja -->
            <div class="d-flex justify-content-center">
                {{ $driverTrucks->links('vendor.pagination.bootstrap-4', ['class' => 'pagination pagination-sm']) }}
            </div>
            <!-- Filtracja -->
            <form method="GET" action="{{ route('driver.order.in_progress') }}">
                <div class="row">
                    <div class="col-md-2">
                        <input type="text" name="place_of_loading" class="form-control" placeholder="Miejsce załadunku" value="{{ request('place_of_loading') }}">
                    </div>
                    <div class="col-md-2">
                        <input type="date" name="loading_date" class="form-control" value="{{ request('loading_date') }}">
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="place_of_delivery" class="form-control" placeholder="Miejsce dostawy" value="{{ request('place_of_delivery') }}">
                    </div>
                    <div class="col-md-2">
                        <input type="date" name="delivery_date" class="form-control" value="{{ request('delivery_date') }}">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Filtruj</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-12">
            @if ($driverTrucks->isEmpty())
                <p>Brak aktywnych zleceń.</p>
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
                            <td>{{ $order->order->loading_date ?? 'Brak daty załadunku' }}</td>
                            <td>{{ $order->order->place_of_delivery }}</td>
                            <td>{{ $order->order->delivery_date ?? 'Brak daty dostawy' }}</td>
                            <td>
                                @if (is_null($order->starting_mileage))
                                    <form action="{{ route('driver.order.in_progress_detal', ['id' => $order->id]) }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="start_mileage">Wprowadź stan licznika:</label>
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
