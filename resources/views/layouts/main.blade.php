<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="icon" href="/img/icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.34/moment-timezone-with-data.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="antialiased">
    <div class="container-fluid">

        <header>
            <div class="banner">
                <a href="{{ route('welcome') }}"><img src="/img/icon.webp"></a>
            </div>
            <div>
                <ul class="menuHeader">
                    @guest
                    @if ($menu == true)
                    <li><a href="{{ route('login') }}"><i class="fa-solid fa-right-to-bracket"></i>&nbsp;Login</a></li>
                    <li><a href="{{ route('registro') }}">Registrarse &nbsp;<i class="fa-solid fa-pen-to-square"></i></a></li>
                    @endif
                    @endguest
                    @auth
                    <a href="{{ route('dashboard') }}">
                        <li><i class="fa-solid fa-house"></i></li>
                    </a>
                    <li><a href="{{ route('logout') }}">Logout &nbsp;<i class="fa-solid fa-arrow-right-from-bracket"></i></a></li>
                    <li><a href=""><i class="fa-solid fa-user"></i> {{ Auth::user()->name }}</a></li>
                    @endauth
                </ul>
            </div>
        </header>

        <main>
            @yield('content')
        </main>

        <footer>
            <div class="row" id="footer">
                <a href="https://www.dragonrojosoftware.online/">
                    <p>Powered by &nbsp;<img src="/img/drs.png" id="drs-icon"> &copy; 2024</p>
                </a>
            </div>
        </footer>

    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
</body>

</html>