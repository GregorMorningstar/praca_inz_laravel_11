@extends('user.user_dashboard')
@section('user_orders')

    <div class="page-content">
        <div class="row">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5>Zlecenia przyjęte do realizacji</h5>

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
                                            <th>Status dostawy</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($in_progresOrders as $order)
                                            <tr>
                                                <td>{{ $order->place_of_loading }}</td>
                                                <td>{{ is_object($order->loading_date) ? $order->loading_date->format('Y-m-d') : $order->loading_date }}</td>
                                                <td>{{ $order->place_of_delivery }}</td>
                                                <td>{{ is_object($order->delivery_date) ? $order->delivery_date->format('Y-m-d') : $order->delivery_date }}</td>
                                                <td>{{ $order->cargo_weight }} kg</td>
                                                <td>{{ $order->cargo_length }} m</td>
                                                <td>{{ $order->mileage }} km</td>
                                                <td>{{ $order->cost }} PLN</td>
                                                <td><a href="#">Look</a></td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9">Nie posiadasz jeszcze zleceń przyjetych do realizacji.</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-center">
                                        {{ $in_progresOrders->links('vendor.pagination.bootstrap-4', ['class' => 'pagination pagination-sm']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
