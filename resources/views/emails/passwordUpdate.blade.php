<!DOCTYPE html>
<html>
<head>
    <title>Registro Exitoso</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .banner {
            background-color: #000;
            color: #ffffff;
            text-align: center;
            padding: 20px 0;
        }
        .banner img {
            height: 50px;
        }
        .container {
            width: 80%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333333;
        }
        p {
            color: #666666;
            line-height: 1.6;
        }
        .icon {
            text-align: center;
            margin: 20px 0;
        }
        .icon img {
            width: 100px;
            height: 100px;
        }
        .button {
            text-align: center;
            margin: 20px 0;
        }
        .button a {
            background-color: #000;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="banner">
        <img src="https://agendasoftware.online/img/icon.webp" alt="Logo de Agenda Software">
    </div>
    <div class="container">
        <h1>¡Hola, {{ $user->name }}!</h1>
        <p>Somos de <strong>AGENDA SOFTWARE</strong>, Su reinicio de contraseña fue un exito!.</p>
        <p>Su nueva contraseña es: <strong>{{ $password }}</strong></p>
    </div>
</body>
</html>








