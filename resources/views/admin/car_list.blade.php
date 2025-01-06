@extends('admin.admin_dashboard')
@section('car_list')
    <div class="page-content">
        <div>
            <form method="GET" action="{{ route('car/list') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-2">
                        <input type="text" name="license_plate" class="form-control"
                               placeholder="Nr Rejestracyjny" value="{{ request('license_plate') }}">
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="brand" class="form-control"
                               placeholder="Marka" value="{{ request('brand') }}">
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="color" class="form-control"
                               placeholder="Kolor" value="{{ request('color') }}">
                    </div>
                    <div class="col-md-2">
                        <input type="number" step="0.01" name="length" class="form-control"
                               placeholder="Długość (m)" value="{{ request('length') }}">
                    </div>
                    <div class="col-md-2">
                        <input type="number" step="0.01" name="height" class="form-control"
                               placeholder="Wysokość (m)" value="{{ request('height') }}">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Filtruj</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="d-flex justify-content-center">
            {{ $trucks->links('vendor.pagination.bootstrap-4', ['class' => 'pagination pagination-sm']) }}
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nr Rejestracyjny</th>
                <th>Marka</th>
                <th>Rok Produkcji</th>
                <th>Przebieg (km)</th>
                <th>Kolor</th>
                <th>Długość (m)</th>
                <th>Wysokość (m)</th>
                <th>VIN</th>
                <th>Kierowca</th>
            </tr>
            </thead>
            <tbody>
            @foreach($trucks as $truck)
                <tr>
                    <td>{{$truck->id}}</td>
                    <td>{{ $truck->license_plate }}</td>
                    <td>{{ $truck->brand }}</td>
                    <td>{{ \Carbon\Carbon::parse($truck->production_year)->format('Y') }}</td>
                    <td>{{ $truck->mileage }}</td>
                    <td>{{ $truck->color }}</td>
                    <td>{{ $truck->length }}</td>
                    <td>{{ $truck->height }}</td>
                    <td>{{ $truck->vin }}</td>
                    <td>{{ $truck->driver ? $truck->driver->name : 'Brak' }}

                        @if($truck->driver)
                            <form action="{{ route('car.remove', $truck->id) }}" method="POST" style="display:inline;">
                                <!-- Corrected syntax -->
                                @csrf
                                <button type="submit" class="btn btn-danger">X</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
