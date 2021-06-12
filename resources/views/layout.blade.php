<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} @yield('title')</title>

    <link href="https://fonts.googleapis.com/css2?family=Grenze+Gotisch:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i|Open+Sans:400,700" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <link rel='stylesheet' href="{{ asset('css/main.css') }}">
    @yield('style')

    <script type="text/javascript">
        const CSRF_TOKEN = '{{ csrf_token() }}';
        @yield('extra_routes')
    </script>
    <script src="{{ asset('js/menuatendina.js') }}" defer> </script>
    @yield('script')

</head>

<body @yield('body_data')>
    <header>
        <nav>
            <div id="logo">
                SANAT - Art in one click!
            </div>
            <div id="links">
                <a href="{{ route('home') }}">Home</a>
                @if( isset($user) )
                <a href="{{ route('gallery') }}">Gallery</a>
                @if( isset($isartista) )
                <a href="{{ route('create') }}">Post</a>
                @endif
                @endif
                <a href="{{ route('search') }}">Search</a>
                @if( isset($user) )
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout">{{ __('Logout') }}</a>
                @else
                <a href="{{ route('login') }}">Login</a>
                @endif

            </div>

            <img id="menu_tendina" src="{{ asset('img/menu.png') }}" />

        </nav>
        <h1>
            @yield('header_content')
        </h1>
    </header>

    @yield('main_content')

    <footer>
        <address>From my tiny room</address>
        <p>Powered by Josephine Migliore O46001207</p>
    </footer>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</body>

</html>