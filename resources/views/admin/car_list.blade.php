@extends('admin.admin_dashboard')
@section('car_list')
    <div class="page-content">

        <!-- Example table -->
        <table class="table table-striped">
            <thead>
            <tr>
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
                    <td>{{ $truck->license_plate }}</td>
                    <td>{{ $truck->brand }}</td>
                    <td>{{ \Carbon\Carbon::parse($truck->production_year)->format('Y') }}</td>
                    <td>{{ $truck->mileage }}</td>
                    <td>{{ $truck->color }}</td>
                    <td>{{ $truck->length }}</td>
                    <td>{{ $truck->height }}</td>
                    <td>{{ $truck->vin }}</td>
                    <td>{{ $truck->driver ? $truck->driver->name : 'Brak' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
