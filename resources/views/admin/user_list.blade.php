@extends('admin.admin_dashboard')
@section('user_list')
    <div class="page-content">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
            <form method="GET" action="{{ route('users/list') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" name="name" class="form-control" placeholder="Imię" value="{{ request('name') }}">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="username" class="form-control" placeholder="Nazwa użytkownika" value="{{ request('username') }}">
                    </div>
                    <div class="col-md-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ request('email') }}">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="phone" class="form-control" placeholder="Telefon" value="{{ request('phone') }}">
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary btn-block search-form">Filtruj</button>
                        </div>
                    </div>
                </div>
            </form>

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
                        <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Czy na pewno chcesz usunąć konto tego użytkownika?')">
                                Usuń Konto
                            </button>
                        </form>
                    </td>

                </tr>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection
