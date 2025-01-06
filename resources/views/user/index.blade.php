@extends('user.user_dashboard')

@section('user')
    <div class="page-content">


        <form action="{{ route('user/dashboard') }}" method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-3">
                    <label for="place_of_loading">Miejsce załadunku</label>
                    <input type="text" name="place_of_loading" id="place_of_loading" class="form-control" value="{{ request('place_of_loading') }}">
                </div>
                <div class="col-md-3">
                    <label for="loading_date">Data załadunku</label>
                    <input type="date" name="loading_date" id="loading_date" class="form-control" value="{{ request('loading_date') }}">
                </div>
                <div class="col-md-3">
                    <label for="place_of_delivery">Miejsce rozładunku</label>
                    <input type="text" name="place_of_delivery" id="place_of_delivery" class="form-control" value="{{ request('place_of_delivery') }}">
                </div>
                <div class="col-md-3">
                    <label for="delivery_date">Data rozładunku</label>
                    <input type="date" name="delivery_date" id="delivery_date" class="form-control" value="{{ request('delivery_date') }}">
                </div>
                <div class="col-md-3">
                    <label for="username">Firma</label>
                    <input type="text" name="username" id="username" class="form-control" value="{{ request('username') }}">
                </div>
                <div class="col-md-3">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="">Wybierz status</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Zakończone</option>
                        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>W trakcie</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary mt-4">Filtruj</button>
                </div>
            </div>
        </form>

        <div class="pt-2.5 d-flex justify-content-center">
            {{ $orders->links('vendor.pagination.bootstrap-4', ['class' => 'pagination pagination-sm']) }}
        </div>

        <!-- Tabela z zleceniami -->
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                <tr>
                    <th>Załadunek</th>
                    <th>Data</th>
                    <th>Rozładunek</th>
                    <th>Data</th>
                    <th>Firma</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->place_of_loading }}</td>
                        <td>{{ $order->loading_date }}</td>
                        <td>{{ $order->place_of_delivery }}</td>
                        <td>{{ $order->delivery_date }}</td>
                        <td>{{ $order->user->username }}</td>
                        <td>{{ $order->status }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
