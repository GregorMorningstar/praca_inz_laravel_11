@extends('user.user_dashboard')

@section('user_orders')

    <div class="page-content">
        <div class="row">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- Paginacja -->
                                <div class="d-flex justify-content-center">
                                    {{ $orders->links('vendor.pagination.bootstrap-4', ['class' => 'pagination pagination-sm']) }}
                                </div>
                                <!-- Formularz filtracji -->
                                <form action="{{ route('user/all/order') }}" method="GET" class="mb-4">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="place_of_loading">Miejsce Załadunku</label>
                                            <input type="text" name="place_of_loading" id="place_of_loading" class="form-control" value="{{ request('place_of_loading') }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="loading_date">Data Załadunku</label>
                                            <input type="date" name="loading_date" id="loading_date" class="form-control" value="{{ request('loading_date') }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="place_of_delivery">Miejsce Dostawy</label>
                                            <input type="text" name="place_of_delivery" id="place_of_delivery" class="form-control" value="{{ request('place_of_delivery') }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="delivery_date">Data Dostawy</label>
                                            <input type="date" name="delivery_date" id="delivery_date" class="form-control" value="{{ request('delivery_date') }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="cargo_weight">Waga (kg)</label>
                                            <input type="number" name="cargo_weight" id="cargo_weight" class="form-control" value="{{ request('cargo_weight') }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="">Wybierz status</option>
                                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Zakończone</option>
                                                <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>W trakcie</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="submit" class="btn btn-primary mt-4">Filtruj</button>
                                        </div>
                                    </div>
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
                                        @forelse($orders as $order)
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
                                                <td colspan="9">Brak zleceń do wyświetlenia.</td>
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
