@extends('admin.admin_dashboard')
@section('driver_list')
    <div class="page-content">
        <form method="GET" action="{{ route('driver/list') }}" class="mb-4">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" name="name" class="form-control"
                           placeholder="Imię" value="{{ request('name') }}">
                </div>
                <div class="col-md-3">
                    <input type="text" name="username" class="form-control"
                           placeholder="Nazwa użytkownika" value="{{ request('username') }}">
                </div>
                <div class="col-md-3">
                    <input type="email" name="email" class="form-control"
                           placeholder="Email" value="{{ request('email') }}">
                </div>
                <div class="col-md-3">
                    <input type="text" name="license_plate" class="form-control"
                           placeholder="Nr Rej" value="{{ request('license_plate') }}">
                </div>
            </div>
            <div class="row mt-3 justify-content-center">
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary btn-block search-form">Filtruj</button>
                </div>
            </div>
        </form>

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
