@extends('user.user_dashboard')
@section('user')
    <div class="page-content">

        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Panel Usera Giełdy Transportowej</h4>
            </div>
            <div class="d-flex align-items-center flex-wrap text-nowrap">
                <div class="input-group flatpickr wd-200 me-2 mb-2 mb-md-0" id="dashboardDate">
                    <span class="input-group-text input-group-addon bg-transparent border-primary" data-toggle><i data-feather="calendar" class="text-primary"></i></span>
                    <input type="text" class="form-control bg-transparent border-primary" placeholder="Select date" data-input>
                </div>
            </div>
        </div>
        <div class="pt-2.5 d-flex justify-content-center">
            {{ $orders->links('vendor.pagination.bootstrap-4', ['class' => 'pagination pagination-sm']) }}
        </div>
        <!-- Tabela z zleceniami -->
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                <tr>
                    <th>Załądunek</th>
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
