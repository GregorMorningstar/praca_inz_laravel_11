@extends('admin.admin_dashboard')
@section('car_list')
    <div class="page-content">

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
                            <form action="{{ route('car.remove', $truck->id) }}" method="POST" style="display:inline;"> <!-- Corrected syntax -->
                                @csrf
                                <button type="submit" class="btn btn-danger">X</button>
                            </form>@endif
                      </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
