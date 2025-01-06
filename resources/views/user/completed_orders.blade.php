@extends('user.user_dashboard')
@section('user_orders')

    <div class="page-content">
        <div class="row">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-center">
                                    {{ $completedOrders->links('vendor.pagination.bootstrap-4', ['class' => 'pagination pagination-sm']) }}
                                </div>
                                <form method="GET" action="{{ route('user.order.completed') }}">
                                    <div class="row mb-4">
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
                                            <input type="number" name="cargo_weight" class="form-control" placeholder="Waga" value="{{ request('cargo_weight') }}">
                                        </div>
                                        <div class="col-md-2">

                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Filtruj</button>
                                </form>

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Miejsce Załadunku</th>
                                            <th>Data Załadunku</th>
                                            <th>Miejsce Dostawy</th>
                                            <th>Data Dostawy</th>
                                            <th>Waga (kg)</th>
                                            <th>Długość (m)</th>
                                            <th>Kilometrów</th>
                                            <th>Koszt (PLN)</th>
                                            <th>Zleceniodawca</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($completedOrders as $order)
                                            <tr>
                                                <td>{{ $order->place_of_loading }}</td>
                                                <td>{{ is_object($order->loading_date) ? $order->loading_date->format('Y-m-d') : $order->loading_date }}</td>
                                                <td>{{ $order->place_of_delivery }}</td>
                                                <td>{{ is_object($order->delivery_date) ? $order->delivery_date->format('Y-m-d') : $order->delivery_date }}</td>
                                                <td>{{ $order->cargo_weight }} kg</td>
                                                <td>{{ $order->cargo_length }} m</td>
                                                <td>{{ $order->mileage }} km</td>
                                                <td>{{ $order->cost }} PLN</td>
                                                <td>{{ $order->user->name }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9">Nie posiadasz jeszcze wykonanych zleceń.</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
