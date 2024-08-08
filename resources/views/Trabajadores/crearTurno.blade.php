<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$empresa->nombre}}</title>
    <link rel="icon" href="{{ asset('storage/' . $empresa->image) }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap');

        :root {
            --fontsize: 2.6rem;
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

            background-image: url("{{ asset('storage/' . $trabajador->background) }}");
            background-color: #000000;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        html {
            background-color: #000000;
            font-size: 62.5%;
        }

        .container-fluid {
            color: #FFFFFF;
            overflow: hidden;
            font-family: "Nunito", light;
        }

        .banner {
            text-align: center;
            margin-top: 2rem;
        }

        .imgProf {
            width: 12rem;
            border-radius: 50%;
            margin-bottom: 2rem;
        }

        #drs-icon {
            width: 2.25rem;
            margin-top: .3rem;
        }

        #footer {
            text-align: center;
            position: fixed;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            width: 100%;
            height: 3rem;
        }

        #footer a {
            text-decoration: none;
            color: #7D99B2;
        }

        .pageDetails {
            margin-top: 1rem;
            margin-bottom: 12rem;
            width: 100%;
            display: flex;
            justify-content: center;
            font-size: 1.5rem;
        }

        .pageDetails p {
            font-size: 1.5rem;
        }

        .pageDetails input {
            font-size: 1.5rem;
        }

        .pageDetails select {
            font-size: 1.5rem;
        }

        .pageDetails a {
            font-size: 1.5rem;
        }

        .pageDetails button {
            font-size: 1.5rem;
        }

        .pageDetails h1 {
            font-size: 2.6rem;
        }

        .turnosForm div p {
            background: linear-gradient(to bottom right, #7D99B2, #2d72ad);
            padding: .5rem;
            border-radius: 1rem;
        }

        .turnosForm div h1 {
            background: linear-gradient(to bottom right, #7D99B2, #2d72ad);
            padding: .5rem;
            border-radius: 1rem;
        }

        .turnosForm div label {
            background: linear-gradient(to bottom right, #7D99B2, #2d72ad);
            padding: .5rem;
            border-radius: 1rem;
        }
    </style>
</head>

<body class="antialiased">
    <div class="container-fluid">

        <header>
            <div class="banner">
                    @if($trabajador->image != null)
                    <img src="{{ asset('storage/' . $trabajador->image) }}" alt="Imagen de {{ $trabajador->nombre }}" class="imgProf" onclick="document.getElementById('fileInput').click();">
                    @else
                    <img src="{{ asset('storage/' . $empresa->image) }}" alt="Imagen de {{ $trabajador->nombre }}" class="imgProf" onclick="document.getElementById('fileInput').click();">
                    @endif
            </div>
        </header>

        <main>
            <div class="pageDetails text-center">
                <div class="turnosForm">
                    <form method="POST" action="{{ route('turnos-createClienteEmpresa') }}">
                        @csrf
                        <div>
                            <p>{{$trabajador->frase}}</p>
                        </div>
                        <div class="mb-3">
                            <h1>Turno para {{ $trabajador->nombre }}</h1>
                        </div>
                        <div class="mb-3">
                            <input type="hidden" value="{{ $trabajador->id }}" id="trabajadorId" name="trId">
                            <input type="hidden" value="{{ $token }}" id="tokenId" name="token">
                            <input type="hidden" value="{{ $lapsos }}" name="lapsos">
                            <small style="color:red">{{ $message }}</small>
                        </div>
                        <div class="mb-3">
                            <label for="userInput" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="userInput" name="name" required autocomplete="off" value="{{ old('name') }}">
                        </div>
                        <div class="mb-3">
                            <label for="telefonoInput" class="form-label">Telefono</label>
                            <input type="text" class="form-control" id="telefonoInput" name="telefono" required autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="fecha">Selecciona una fecha:</label><br>
                            <input class="form-control" type="date" id="fecha" name="fecha">
                        </div>
                        <div class="mb-3">
                            <label for="horario" class="form-label">Horario</label>
                            <select class="form-control" id="horario" name="horario" required autocomplete="off" disabled>
                                <option>--.--</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-warning">Agendar</button>
                        </div>
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
        const fechaInput = document.getElementById('fecha');
        const horarioSelect = document.getElementById('horario');
        const usuarioIdInput = document.getElementById('trabajadorId'); // Cambio de nombre aquí
        const tokenIdInput = document.getElementById('tokenId'); // Cambio de nombre aquí

        const now = new Date();
        const offset = -3 * 60;
        const adjustedDate = new Date(now.getTime() + (offset * 60 * 1000));
        const today = adjustedDate.toISOString().split('T')[0];
        document.getElementById('fecha').setAttribute('min', today);

        fechaInput.addEventListener('change', function() {
            const fecha = fechaInput.value;
            const trabajadorId = usuarioIdInput.value; // Cambio de nombre aquí
            const tokenId = tokenIdInput.value; // Cambio de nombre aquí

            if (fecha) {
                fetch(`/api/horariosclienteEmpresa?fecha=${fecha}&usp=${trabajadorId}&token=${tokenId}`) // Utilizando usuarioId en lugar de $useridInput
                    .then(response => response.json())
                    .then(data => {
                        horarioSelect.innerHTML = '<option value="">Seleccione un horario</option>';
                        data.forEach(horario => {
                            const option = document.createElement('option');
                            option.value = horario;
                            option.textContent = horario;
                            horarioSelect.appendChild(option);
                        });
                        horarioSelect.disabled = false;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        horarioSelect.disabled = true;
                        horarioSelect.innerHTML = '<option value="">No disponible</option>';
                    });
            } else {
                horarioSelect.disabled = true;
                horarioSelect.innerHTML = '<option value="">Seleccione una fecha primero</option>';
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>