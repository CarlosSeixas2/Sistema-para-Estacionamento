<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <script type="module" src="/js/app.js"></script>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="/css/style.css">

        <script>
            setTimeout(function() {
                document.querySelector('.msg').style.display = 'none';
            }, 2800);
        </script>
    </head>
    <body class="antialiased">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid container_navbar">
                <img class="logo" src="/img/parking.png" alt="logo_site">
                @guest
                <div>
                    <a href="/login">Login</a>
                    <a href="/register">Registro</a>
                </div>
                @endguest
                @auth
                <form action="/logout" method="POST">
                    @csrf
                    <a href="/logout" onclick="event.preventDefault(); 
                    this.closest('form').submit();">Logout</a>
                </form>
                @endauth
            </div>
        </nav>
        <main>
            @if(session('success'))
                <div class="alert alert-success msg" role="alert">
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger msg" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
        <footer>
            <p>By Carlos Seixas</p>
        </footer>
    </body>
</html>
