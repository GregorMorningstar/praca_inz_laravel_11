@extends('driver.driver_dashboard')

@section('driver')
    <div class="container mt-7">

        <div class="row text-center">
            <div class="col-md-6" style="height: 33vh; overflow-y: auto;">
                <div class="mt-9">
                    <h4>Dane użytkownika</h4>
                    <ul class="list-unstyled">
                        <li><strong>Imię:</strong> {{ $user->name }}</li>
                        <li><strong>Email:</strong> {{ $user->email }}</li>
                        <li><strong>Telefon:</strong> {{ $user->phone }}</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6" style="height: 33vh; overflow-y: auto;">
                <div>
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
        </div>



        <div class="col-12">

            <div class="d-flex justify-content-center">
                {{ $driverTrucks->links('vendor.pagination.bootstrap-4', ['class' => 'pagination pagination-sm']) }}
            </div>            <!-- Filtracja -->
            <div class="col-12 mb-4">
                <form method="GET" action="{{ route('driver/dashboard') }}">
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
                            <td>{{ optional($order->order->loading_date)->format('Y-m-d') }}</td>
                            <td>{{ $order->order->place_of_delivery }}</td>
                            <td>{{ optional($order->order->delivery_date)->format('Y-m-d') }}</td>
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
@endsection
