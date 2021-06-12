<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/login.js') }}"  defer> </script>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>LOGIN</title>
</head>

<body>

    <h1>Welcome to the login page</h1>
    @isset($errori) 
        @foreach ($errori as $e)
            <p>Errore: {{ $e }}</p>
        @endforeach
        
         @endisset 
    <div>
        <form name="login" method="POST" enctype="multipart/form-data" autocomplete="off" action="{{ route('login') }}">
        @csrf
            <p>
                <label>Username:<input type="text" name="username" value=<?php if (isset($_COOKIE["username"])) echo $_COOKIE["username"] ?>></label>
            </p>
            <p>
                <label>Password:<input type="password" name="password" value=<?php if (isset($_COOKIE["password"])) echo $_COOKIE["password"] ?>></label>
            </p>
            <p>
                <label>Remember me:<input type="checkbox" name="ricordami"></label>
            </p>
            <p>
                <label>&nbsp;<input type="submit"></label>
            </p>
        </form>
        <p class="tap">
            You don't have an account? <a href="{{ route('register') }}">Click here!</a>
        </p>

    </div>

</body>

</html>