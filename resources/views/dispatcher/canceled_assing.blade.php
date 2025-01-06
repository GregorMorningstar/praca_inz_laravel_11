@extends('dispatcher.dispatcher_dashboard')

@section('dispatcher')
    <div class="page-content">
        <h4 class="text-center">Wycofane zlecenia</h4>
        <div class="container mt-4">
            <div class="d-flex justify-content-center">
                {{ $canceledOrder->links('vendor.pagination.bootstrap-4', ['class' => 'pagination pagination-sm']) }}
            </div>
            <form method="GET" action="{{ route('spedytor/order/canceled') }}">
                <div class="row">
                    <div class="col-md-3">
                        <label for="place_of_loading">Miejsce załadunku</label>
                        <input type="text" name="place_of_loading" id="place_of_loading" class="form-control" value="{{ request('place_of_loading') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="place_of_delivery">Miejsce dostawy</label>
                        <input type="text" name="place_of_delivery" id="place_of_delivery" class="form-control" value="{{ request('place_of_delivery') }}">
                    </div>
                    <div class="col-md-2">
                        <label for="start_date">Data załadunku od</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-2">
                        <label for="end_date">Data dostawy do</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Filtruj</button>
                    </div>
                </div>
            </form>

            <hr>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($canceledOrder->isEmpty())
                <p>Brak zleceń do przyjęcia.</p>
            @else
                <table class="table table-striped table-responsive-sm">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Miejsce załadunku</th>
                        <th>Data załadunku</th>
                        <th>Miejsce dostawy</th>
                        <th>Data dostawy</th>
                        <th>Przyjmij</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($canceledOrder as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->place_of_loading }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->loading_date)->format('Y-m-d') }}</td>
                            <td>{{ $item->place_of_delivery }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->delivery_date)->format('Y-m-d') }}</td>
                            <td>
                                <form action="{{ route('order/status/in_progress', $item->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-recycle"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>


            @endif
        </div>
    </div>
@endsection
