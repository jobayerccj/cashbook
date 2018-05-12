@include('layouts.header')

@if (Route::has('login'))
            
    @auth
        @include('layouts.logged_in_header')
        @yield('content')
       	@include('layouts.logged_in_footer')
    @else
        @yield('content')
    @endauth
            
@endif

@include('layouts.footer')


