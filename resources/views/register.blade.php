
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SIGN UP</title>
        <script src= "{{ asset('js/signup.js') }}" defer > </script>
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
        <link rel="stylesheet" href="{{ asset('css/signup.css') }}">
        <script type="text/javascript">
            const url_checkUsername="{{ route('checkUsername') }}";
        </script>

        
    </head>
    
    <body>
      
        <h1>Welcome, fill in the fields to register! </h1>
        @isset($errori) 
        @foreach ($errori as $e)
            <p>Errore: {{ $e }}</p>
        @endforeach
        
         @endisset 
        <div>
            <form name="signup" method="post" enctype="multipart/form-data" autocomplete="off" action="{{ route('register') }}">
            @csrf

            <p>
                <label>Name:<input type="text" name="nome"></label>

            </p>
            <p>
                <label>Surname:<input type="text" name="cognome"></label>

            </p>
            <p>
                <label>Username:<input type="text" name="username"></label>
            </p>
            <p>
                <label>Email:<input type="text" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"></label>

            </p>
            <p>
                <label>Password:<input type="password" name="password"></label>

            </p>
            <p>
                <label>Confirm Password:<input type="password" name="conferma"></label>

            </p>
            <p>
                <label>Profile Pic:<input type="file" name="immagine" accept="image/jpeg, image/png"></label>

            </p>
            <p>
                <label>Are you an artist or a visitor?</label>
                <input type="radio" name="artista_visitatore" value="-1" id="visitatore" checked >
                <label for="visitatore">visitor</label>
                <input type="radio" name="artista_visitatore" value="0" id="artista">
                <label for="artista">artist</label>
            </p>
            
            <p>
                <label>&nbsp;<input type="submit"></label>

            </p>
            </form>
            <p class="tap">
            Do you already have an account? <a href="{{ route('login') }}">Click here!</a>
            </p>
        </div>
    </body>
</html>


