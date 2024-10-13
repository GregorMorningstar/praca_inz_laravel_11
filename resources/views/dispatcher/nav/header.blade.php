<!-- partial:partials/_navbar.html -->
<nav class="navbar">
    <div>
        <h1 class=" text-xs pl-4">     Spedytor  {{ Auth::user()->name }}</h1> <!-- Wyświetla nazwę zalogowanego użytkownika -->
    </div>

    <div>
        <form action="{{ route('spedytor.logout') }}" method="GET">
            @csrf
            <button class="btn btn-inverse-danger ">
                Logout
            </button>
        </form>
    </div>
</nav>

