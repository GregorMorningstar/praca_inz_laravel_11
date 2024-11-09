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
        <div id='calendar'></div>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',

                    events: [
                            @foreach($orders as $order)
                        {
                            title: '{{ $order->place_of_delivery }}',  // The title from your order
                            start: '{{ $order->loading_date }}',       // Start date from the order
                            end: '{{ $order->delivery_date }}'         // End date from the order
                        }
                        @if (!$loop->last), @endif  // Prevent trailing comma after the last element
                        @endforeach
                    ]
                });

                calendar.render();
            });
        </script>
    </div>
@endsection
