@extends('admin.admin_dashboard')
@section('dispatcher_list')
    <div class="page-content">
        <div class="d-flex justify-content-center">
            {{ $dispatchers->links('vendor.pagination.bootstrap-4', ['class' => 'pagination pagination-sm']) }}
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
            @foreach($dispatchers as $dispatcher)
                <tr>
                    <td>{{ $dispatcher->id }}</td>
                    <td>{{ $dispatcher->name }}</td>
                    <td>{{ $dispatcher->username }}</td>
                    <td>{{ $dispatcher->email }}</td>
                    <td>{{ $dispatcher->phone }}</td>
                    <td>
                        <a href="#" class="btn btn-primary btn-sm">Edytuj</a>
                        {{--                        @if($driver->hasTruck())--}}
                        <a href="#" class="btn btn-danger btn-sm">Usuń samochód</a>
                        {{--                        @else--}}
                        <a href="#" class="btn btn-secondary btn-sm">Przypisz samochód</a>
                        {{--                        @endif--}}
                    </td>
                </tr>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

@endsection
