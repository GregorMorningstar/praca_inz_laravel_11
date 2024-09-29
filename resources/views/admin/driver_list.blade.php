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
                <th>Akcje</th> <!-- Nowa kolumna na akcje -->
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
                    <td>
                        @if($driver->truck)
                            <a href="{{ route('car.remove', $driver->truck->id) }}" class="btn btn-danger btn-sm">Usuń samochód</a>
                        @elseif(!$driver->truck)
                            <a href="#" class="btn btn-secondary btn-sm">Przypisz samochód</a>
                        @endif
                    </td>
                </tr>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection
