<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="icon" href="/img/icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="antialiased">
    <div class="container-fluid">

        <header>
            <div class="banner">
                <img src="/img/icon.webp">
            </div>
            <div>
                <ul class="menuHeader">
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('registro') }}">registrarse</a></li>
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
    <script src="/js/scripts.js"></script>
    <scrip src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
</body>

</html>