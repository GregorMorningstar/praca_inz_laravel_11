
    @if(Auth::check())

            <p>Welcome, {{ Auth::user()->name }}!</p>

            {{return redirect()->route("{{!!Auth::user()->role !!}}'.dashboard'")}};
    @else

        <p>Please <a href="{{ route('login') }}">log in</a> to access this content.</p>
    @endif
