@extends('admin.admin_dashboard')
@section('car')
    <div class="page-content">

        <form action="{{route('car/addStore')}}" method="POST" class="w-50 mx-auto mt-5">
            @csrf

            <!-- License Plate -->
            <div class="form-group text-center">
                <label for="license_plate" class="font-weight-bold">Nr Rejestracyjny</label>
                <input type="text" name="license_plate" id="license_plate" class="form-control form-control-sm mx-auto" value="{{ old('license_plate') }}" required>
                @error('license_plate')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Production Year (year input) -->
            <div class="form-group text-center">
                <label for="production_year" class="font-weight-bold">Rok produkcji</label>
                <input type="number" name="production_year" id="production_year" class="form-control form-control-sm mx-auto"
                       value="{{ old('production_year') }}" min="1900" max="{{ \Carbon\Carbon::now()->format('Y') }}" required>
                @error('production_year')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>




            <!-- Brand -->
            <div class="form-group text-center">
                <label for="brand" class="font-weight-bold">Marka</label>
                <select name="brand" id="brand" class="form-control form-control-sm mx-auto" required>
                    <option value="" disabled selected>Wybierz markę</option>
                    <option value="Volvo" {{ old('brand') == 'Volvo' ? 'selected' : '' }}>Volvo</option>
                    <option value="Man" {{ old('brand') == 'Man' ? 'selected' : '' }}>Man</option>
                    <option value="Scania" {{ old('brand') == 'Scania' ? 'selected' : '' }}>Scania</option>
                    <option value="Renault" {{ old('brand') == 'Renault' ? 'selected' : '' }}>Renault</option>
                    <option value="Ford" {{ old('brand') == 'Ford' ? 'selected' : '' }}>Ford</option>
                    <option value="Daf" {{ old('brand') == 'Daf' ? 'selected' : '' }}>Daf</option>
                </select>
                @error('brand')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Mileage -->
            <div class="form-group text-center">
                <label for="mileage" class="font-weight-bold">Przebieg (km)</label>
                <input type="number" name="mileage" id="mileage" class="form-control form-control-sm mx-auto" value="{{ old('mileage') }}" required>
                @error('mileage')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Color -->
            <div class="form-group text-center">
                <label for="color" class="font-weight-bold">Kolor</label>
                <input type="text" name="color" id="color" class="form-control form-control-sm mx-auto" value="{{ old('color') }}" required>
                @error('color')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Length -->
            <div class="form-group text-center">
                <label for="length" class="font-weight-bold">Długość (meters)</label>
                <input type="number" step="0.01" name="length" id="length" class="form-control form-control-sm mx-auto" value="{{ old('length') }}" required>
                @error('length')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Height -->
            <div class="form-group text-center">
                <label for="height" class="font-weight-bold">Wysokość (meters)</label>
                <input type="number" step="0.01" name="height" id="height" class="form-control form-control-sm mx-auto" value="{{ old('height') }}" required>
                @error('height')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- VIN -->
            <div class="form-group text-center">
                <label for="vin" class="font-weight-bold">VIN</label>
                <input type="text" name="vin" id="vin" class="form-control form-control-sm mx-auto" value="{{ old('vin') }}" required>
                @error('vin')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="form-group text-center mt-1.5">
                <button type="submit" class="btn btn-primary">Dodaj ciężarówkę</button>
            </div>
        </form>
    </div>
@endsection
