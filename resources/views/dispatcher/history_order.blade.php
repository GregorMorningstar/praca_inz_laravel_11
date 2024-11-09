@extends('dispatcher.dispatcher_dashboard')
@section('dispatcher')
    <div class="page-content">
        <h4 class="text-center">Historia zleceń</h4>
        <div class="container mt-4"> <!-- Dodaj margin-top do kontenera -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if ($historyOrder->isEmpty())
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
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($historyOrder as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->place_of_loading }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->loading_date)->format('Y-m-d') }}</td>
                            <td>{{ $item->place_of_delivery }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->delivery_date)->format('Y-m-d') }}</td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
