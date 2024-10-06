@extends('dispatcher.dispatcher_dashboard')
@section('dispatcher')
    <div class="page-content">
        <h4 class="text-center">Ostatnio dodane zlecenia</h4>
        <div class="container mt-4"> <!-- Dodaj margin-top do kontenera -->
            <h1>Pending Orders</h1>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if ($activeOrder->isEmpty())
                <p>Brak zleceń do przyjęcia.</p>
            @else
                <table class="table  table-responsive">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Miejsce załadunku</th>
                        <th>Data załadunku</th>
                        <th>Miejsce dostawy</th>
                        <th>Data dostawy</th>
                        <th>Waga towaru</th>
                        <th>Długość towaru</th>
                        <th>Ilość kilometrów</th>
                        <th>Koszt</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($activeOrder as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->place_of_loading }}</td>
                            <td>{{ $item->loading_date->format('Y-m-d') }}</td>
                            <td>{{ $item->place_of_delivery }}</td>
                            <td>{{ $item->delivery_date->format('Y-m-d') }}</td>
                            <td>{{ $item->cargo_weight }} kg</td>
                            <td>{{ $item->cargo_length }} m</td>
                            <td>{{ $item->mileage }} km</td>
                            <td>{{ $item->cost }} PLN</td>
                            <td>
                                <a href="{{ route('spedytor/przydziel', $item->id) }}" class="btn btn-primary">
                                    <i class="fas fa-car"></i> <!-- Ikona samochodu -->
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('spedytor/order/cancel', $item->id) }}" class="btn btn-danger">
                                    <i class="fas fa-times"></i> <!-- Ikona X -->
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
