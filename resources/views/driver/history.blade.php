@extends('driver.driver_dashboard')
@section('driver')
    <div class="container mt-7">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
            <div class="col-12 ">
                <h1 class="text-primary text-center">Historia zlecenia</h1>
            </div>
    </div>

@endsection
