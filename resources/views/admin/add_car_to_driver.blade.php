@extends('admin.admin_dashboard')

@section('add_driver_to_car')
    <div class="page-content">
        <h1>Lista Kierowców</h1>
        <div class="d-flex justify-content-center">
            {{ $drivers->links('vendor.pagination.bootstrap-4', ['class' => 'pagination pagination-sm']) }}
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nazwa Użytkownika</th> <!-- Changed to "Nazwa Użytkownika" (User Name) -->
                <th>Numer Rejestracyjny</th>
                <th>Status Trucka</th>
                <th>Imię</th>
                <th>Email</th>
                <th>Akcje</th>
            </tr>
            </thead>
            <tbody>
            @foreach($drivers as $driver)
                <tr>
                    <td>{{ $driver->id }}</td>
                    <td>{{ $driver->username ?? 'Brak' }}</td> <!-- Show the user's name -->
                    <td>{{ $driver->truck ? $driver->truck->license_plate : 'Brak' }}</td> <!-- Show license plate -->
                    <td>{{ $driver->truck ? $driver->truck->status : 'Brak' }}</td>
                    <td>{{ $driver->name }}</td> <!-- Show driver's name -->
                    <td>{{ $driver->email }}</td>
                    <td>
                        @if($driver->truck)
                            <form action="{{ route('car.remove', $driver->truck->id) }}" method="POST" style="display:inline;"> <!-- Poprawiony atrybut action -->
                                @csrf
                                <button type="submit" class="btn btn-danger">Usuń Samochód</button>
                            </form>
                        @else
                            <form action="{{ route('car.assign', $driver->id) }}" method="GET" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-primary">Przypisz Samochód</button>
                            </form>
                        @endif
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
