@extends('admin.admin_dashboard')
@section('user_list')
    <div class="page-content">
        <div class="d-flex justify-content-center">
            {{ $users->links('vendor.pagination.bootstrap-4', ['class' => 'pagination pagination-sm']) }}
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
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>
                        <a href="#" class="btn btn-primary btn-sm">Edytuj</a>
                        {{--                        @if($driver->hasTruck())--}}
                        <a href="#" class="btn btn-danger btn-sm">Usuń</a>

                    </td>
                </tr>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection
