@extends('admin.admin_dashboard')
@section('dispatcher_list')

    <div class="page-content">
        <form method="GET" action="{{ route('dispatcher/list') }}" class="mb-4">
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
                    <button type="submit" class="btn btn-primary">Filtruj</button>
                </div>
            </div>
        </form>
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

                </tr>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

@endsection
