@extends('user.user_dashboard')
@section('order')
    <div class="page-content">
        <h1 class="text-center my-4">Dodaj Nowe Zamówienie</h1>
        <form action="#" method="POST">
            @csrf

            <div class="form-group">
                <label for="place_of_loading">Miejsce Załadunku</label>
                <input type="text" name="place_of_loading" id="place_of_loading" class="form-control" value="{{ old('place_of_loading') }}" required>
                @error('place_of_loading')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="loading_date">Data Załadunku</label>
                <input type="date" name="loading_date" id="loading_date" class="form-control" value="{{ old('loading_date') }}" required>
                @error('loading_date')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="place_of_delivery">Miejsce Dostawy</label>
                <input type="text" name="place_of_delivery" id="place_of_delivery" class="form-control" value="{{ old('place_of_delivery') }}" required>
                @error('place_of_delivery')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="delivery_date">Data Dostawy</label>
                <input type="date" name="delivery_date" id="delivery_date" class="form-control" value="{{ old('delivery_date') }}" required>
                @error('delivery_date')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="cargo_weight">Waga Towaru</label>
                <input type="number" step="0.01" name="cargo_weight" id="cargo_weight" class="form-control" value="{{ old('cargo_weight') }}" required>
                @error('cargo_weight')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="cargo_length">Długość Towaru</label>
                <input type="number" step="0.01" name="cargo_length" id="cargo_length" class="form-control" value="{{ old('cargo_length') }}" required>
                @error('cargo_length')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="mileage">Ilość Kilometrów</label>
                <input type="number" name="mileage" id="mileage" class="form-control" value="{{ old('mileage') }}" required>
                @error('mileage')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="cost">Koszt</label>
                <input type="number" step="0.01" name="cost" id="cost" class="form-control" value="{{ old('cost') }}" required>
                @error('cost')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>



            <button type="submit" class="btn btn-primary">Dodaj Zamówienie</button>
        </form>

    </div>
@endsection
