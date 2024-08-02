<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$empresa->nombre}}</title>
    <link rel="icon" href="{{ Storage::url($empresa->image) }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap');

        :root {
            --fontsize: 2vw;
            --fontsizeCel: 5vw;
            --color-AirBlue: #7D99B2;
            --color-Pear: #C2E150;
            --color-Black: #000000;
            --color-White: #FFFFFF;
        }

        body {
            margin: auto;
            height: 100%;
            width: 100%;
            padding: 0;
            overflow-x: hidden;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;

            background-color: #000000;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .container-fluid {
            color: #FFFFFF;
            overflow: hidden;
            font-family: "Nunito", light;
            min-height: 100vh;
        }

        .banner {
            text-align: center;
        }

        .imgProf {
            width: 10vw;
            border-radius: 50%;
            margin-top: 2vh;
            margin-bottom: 2vh;
        }

        #drs-icon {
            width: 1.5vw;
        }

        #footer {
            text-align: center;
            position: fixed;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            /* Fondo negro con 50% de opacidad */
            z-index: 1000;
            width: 100%;
            height: 4vh;
        }

        #footer a {
            text-decoration: none;
            color: #7D99B2;
        }

        .banner h1 {
            font-size: 3vw;
        }

        .LinkCaducado {
            height: 50vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        @media (max-width: 800px) {
            .imgProf {
                width: 20vh;
                border-radius: 50%;
                margin-top: 2vh;
                margin-bottom: 2vh;
            }

            #drs-icon {
                width: 2.5vh;
            }

            .banner h1 {
                font-size: 5vw;
            }

            .trabajadores-menu a div {
                display: flex;
                justify-content: center;
                background: linear-gradient(to bottom right, #7D99B2, #2d72ad);
                clip-path: polygon(10% 0%, 100% 0%, 90% 100%, 0% 100%);
                border-radius: 20px;
                color: #000000;
                width: 50vh;
                cursor: pointer;
                transform: translateY(0vh);
                margin-bottom: 1vw;
            }

            .trabajadores-menu div h1 {
                font-size: 7vw;
                margin-top: 5px;
            }

        }
    </style>
</head>

<body class="antialiased">
    <div class="container-fluid">

        <header>
            <div class="banner">
                @if($empresa->image != null)
                <img src="{{ Storage::url($empresa->image) }}" alt="Imagen de {{ $empresa->nombre }}" class="imgProf">
                @endif
                <h1>{{$empresa->nombre}}</h1>
            </div>
        </header>

        <main>
            <div class="LinkCaducado text-center">
                <div>
                    <h1>Link Caducado<i class="fa-solid fa-circle-xmark" style="color:red;"></i></h1>
                </div>
                <div>
                    <h4>Comuniquese con el proveedor</h4>
                </div>
            </div>
        </main>

        <footer>
            <div class="row" id="footer">
                <a href="https://www.dragonrojosoftware.online/">
                    <p>Powered by &nbsp;<img src="/img/drs.png" id="drs-icon"> &copy; 2024</p>
                </a>
            </div>
        </footer>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>