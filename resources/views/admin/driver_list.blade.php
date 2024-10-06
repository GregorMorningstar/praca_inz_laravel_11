@extends('admin.admin_dashboard')
@section('driver_list')
    <div class="page-content">
        <div class="d-flex justify-content-center">
            {{ $drivers->links('vendor.pagination.bootstrap-4', ['class' => 'pagination pagination-sm']) }}
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Imię</th>
                <th>Nazwa użytkownika</th>
                <th>Email</th>
                <th>Telefon</th>
                <th>Nr Rej</th>
            </tr>
            </thead>
            <tbody>
            @foreach($drivers as $driver)
                <tr>
                    <td>{{ $driver->id }}</td>
                    <td>{{ $driver->name }}</td>
                    <td>{{ $driver->username }}</td>
                    <td>{{ $driver->email }}</td>
                    <td>{{ $driver->phone }}</td>
{{--                   <td>{{ $driver->truck ? $driver->truck->license_plate : 'Brak' }}</td>--}}
                    <td>
                        @if(!$driver->truck)
                            <a href="{{ route('car.assign', $driver->id) }}" class="btn btn-primary">
                                Przypisz samochód
                            </a>
                        @else
                            {{ $driver->truck->license_plate }}
                        @endif
                    </td>
                </tr>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection
