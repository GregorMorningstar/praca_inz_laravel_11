public function AdminListCar(Request $request)
{
$query = Truck::with('driver'); // Inicjalizujemy zapytanie

// Dodajemy warunki filtrowania
if ($request->filled('license_plate')) {
$query->where('license_plate', 'LIKE', '%' . $request->license_plate . '%');
}

if ($request->filled('brand')) {
$query->where('brand', 'LIKE', '%' . $request->brand . '%');
}

if ($request->filled('color')) {
$query->where('color', 'LIKE', '%' . $request->color . '%');
}

if ($request->filled('length')) {
$query->where('length', '=', $request->length); // Filtr dokładny dla długości
}

if ($request->filled('height')) {
$query->where('height', '=', $request->height); // Filtr dokładny dla wysokości
}

// Paginate wyniki
$trucks = $query->paginate(5);

// Przekazanie wyników do widoku
return view('admin.car_list', compact('trucks'));
}
