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

            background-image: url('{{ Storage::url($trabajador->background) }}');
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

        .pageDetails {
            height: 100vh;
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .turnosForm div p {
            background: linear-gradient(to bottom right, #7D99B2, #2d72ad);
            padding: 2px;
            border-radius: 10px;
        }

        .turnosForm div h1 {
            background: linear-gradient(to bottom right, #7D99B2, #2d72ad);
            padding: 2px;
            border-radius: 10px;
        }

        .turnosForm div label {
            background: linear-gradient(to bottom right, #7D99B2, #2d72ad);
            padding: 2px;
            border-radius: 10px;
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
        }
    </style>
</head>

<body class="antialiased">
    <div class="container-fluid">

        <header>
            <div class="banner">
                <form id="uploadForm" action="{{ route('trabajador.updateImage') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" id="fileInput" name="image" class="hidden-file-input" accept="image/*" style="display:none;">
                    <input type="hidden" name="trabajador_id" value="{{ $trabajador->id }}">
                    @if($trabajador->image != null)
                    <img src="{{ Storage::url($trabajador->image) }}" alt="Imagen de {{ $trabajador->nombre }}" class="imgProf" onclick="document.getElementById('fileInput').click();">
                    @else
                    <img src="{{ Storage::url($empresa->image) }}" alt="Imagen de {{ $trabajador->nombre }}" class="imgProf" onclick="document.getElementById('fileInput').click();">
                    @endif
                </form>
            </div>
        </header>

        <main>
            <div class="pageDetails text-center">
                <div class="turnosForm">
                    @if (session('info'))
                    <div class="alert alert-info">
                        {{ session('info') }}
                    </div>
                    @endif
                    <div>
                        <p>{{$trabajador->frase}}</p>
                    </div>
                    <div class="mb-3">
                        <h1>Turno para {{ $trabajador->nombre }}</h1>
                    </div>
                    <div class="mb-3">
                        <label for="userInput" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="userInput" name="name" autocomplete="off" value="Nombre del cliente" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="telefonoInput" class="form-label">Telefono</label>
                        <input type="text" class="form-control" id="telefonoInput" name="telefono" value="123456789" autocomplete="off" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="fecha">Selecciona una fecha:</label><br>
                        <input class="form-control" type="date" id="fecha" name="fecha" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="horario" class="form-label">Horario</label>
                        <input type="text" class="form-control" id="telefonoInput" name="telefono" value="HH:MM" autocomplete="off" disabled>
                    </div>
                    <div class="mb-3">
                        <a href="{{ route('trabajadores') }}" class="btn btn-success">volver</a>
                        <button type="submit" class="btn btn-warning" disabled>Agendar</button>
                    </div>
                    </form>

                    <form id="uploadFormBackground" action="{{ route('trabajador.updateBackground') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" id="fileInputBackground" name="image" class="hidden-file-input" accept="image/*" style="display:none;">
                        <input type="hidden" name="trabajador_id" value="{{ $trabajador->id }}">
                        <button type="button" onclick="document.getElementById('fileInputBackground').click();" class="btn btn-info">Cambiar Fondo</button>
                    </form>
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
    <script>
        document.getElementById('fileInput').addEventListener('change', function(event) {
            const file = event.target.files[0];

            if (file) {
                const img = new Image();
                const reader = new FileReader();

                reader.onload = function(e) {
                    img.src = e.target.result;
                };

                img.onload = function() {
                    document.getElementById('uploadForm').submit();
                };

                reader.readAsDataURL(file);
            }
        });

        document.getElementById('fileInputBackground').addEventListener('change', function(event) {
            const file = event.target.files[0];

            if (file) {
                const img = new Image();
                const reader = new FileReader();

                reader.onload = function(e) {
                    img.src = e.target.result;
                };

                img.onload = function() {
                    document.getElementById('uploadFormBackground').submit();
                };

                reader.readAsDataURL(file);
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>