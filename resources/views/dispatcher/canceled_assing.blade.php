@extends('dispatcher.dispatcher_dashboard')
@section('dispatcher')
    <div class="page-content">
        <h4 class="text-center">Wszystkie wykonane zlecenia</h4>
        <div class="container mt-4"> <!-- Dodaj margin-top do kontenera -->
            <h1>Pending Orders</h1>
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
                            <td>{{ $item->loading_date->format('Y-m-d') }}</td>
                            <td>{{ $item->place_of_delivery }}</td>
                            <td>{{ $item->delivery_date->format('Y-m-d') }}</td>

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
