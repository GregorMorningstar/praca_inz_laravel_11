@extends('admin.admin_dashboard')
@section('role')

        <div class= "container mt-7">

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <h2>Lista Użytkowników</h2>
                <!-- Paginacja -->
                <div class="pt-2.5 d-flex justify-content-center">
                    {{ $user->links('vendor.pagination.bootstrap-4', ['class' => 'pagination pagination-sm']) }}
                </div>
            <!-- Sprawdź, czy są użytkownicy -->
            @if($user->count())
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Nazwa użytkownika</th>
                        <th>Email</th>
                        <th>Rola</th>
                        <th>Akcje</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($user as $u)
                        <tr>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td>{{ $u->role }}</td>
                            <td>
                                <!-- Formularz do zmiany roli użytkownika -->
                                <form action="{{ route('admin.update_role', $u->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')

                                    <div class="form-group">
                                        <select name="role" class="form-control">
                                            <option value="user" {{ $u->role == 'user' ? 'selected' : '' }}>user</option>
                                            <option value="dispatcher" {{ $u->role == 'dispatcher' ? 'selected' : '' }}>dispatcher</option>
                                            <option value="driver" {{ $u->role == 'driver' ? 'selected' : '' }}>driver</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-sm">Zmień rolę</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>


            @else
                <p>Brak użytkowników do wyświetlenia.</p>
            @endif
        </div>


@endsection
