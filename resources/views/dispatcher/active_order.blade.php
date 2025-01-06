@extends('dispatcher.dispatcher_dashboard')
@section('dispatcher')
    <div class="page-content">
        <h4 class="text-center">Ostatnio dodane zlecenia</h4>
        <div class="container mt-4"> <!-- Dodaj margin-top do kontenera -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="d-flex justify-content-center mt-4">
                {{ $activeOrder->links('vendor.pagination.bootstrap-4') }}
            </div>
            <form method="GET" action="{{ route('spedytor/order/active') }}" class="mb-4" id="filterForm"> <!-- Dodano id do formularza -->
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" name="place_of_loading" class="form-control" placeholder="Miejsce załadunku" value="{{ request('place_of_loading') }}">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="place_of_delivery" class="form-control" placeholder="Miejsce dostawy" value="{{ request('place_of_delivery') }}">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="cargo_weight" class="form-control" placeholder="Waga towaru" value="{{ request('cargo_weight') }}">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="cargo_length" class="form-control" placeholder="Długość towaru" value="{{ request('cargo_length') }}">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="mileage" class="form-control" placeholder="Ilość kilometrów" value="{{ request('mileage') }}">
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="start_date" class="form-control" placeholder="Data od" value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="end_date" class="form-control" placeholder="Data do" value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary btn-block">Filtruj</button>
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-secondary btn-block" id="resetBtn">Resetuj</button> <!-- Przycisk resetujący z id -->
                    </div>
                </div>
            </form>





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
                            <td>{{ \Carbon\Carbon::parse($item->loading_date)->format('Y-m-d') }}</td>
                            <td>{{ $item->place_of_delivery }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->delivery_date)->format('Y-m-d') }}</td>
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
@push('scrypt')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Upewnij się, że masz załadowany jQuery -->

    <script>
        // JavaScript do resetowania formularza za pomocą jQuery
        $('#resetBtn').click(function() {
            $('#filterForm')[0].reset(); // Resetowanie formularza
            console.log('2'); // Wypisanie do konsoli
        });
    </script>
@endpush
