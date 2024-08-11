@extends('layouts.main')
@section('title', 'Agenda Web')

@section('content')
<div class="configPage">
    <div>
        <h1>Configuracion</h1>
        @if (session('message'))
        <div class="text-success">
            {{ session('message') }} <i class="fa-solid fa-circle-check"></i>
        </div>
        @endif
    </div>
    <hr>
    <div>
        <form id="perfilForm" method="POST" action="{{ route('configPerfilUpdate') }}">
            @csrf
            <table>
                <thead>
                    <tr>
                        <th colspan="3">Perfil</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="configColumn">Nombre</td>
                        <td><input type="text" name="nombre" value="{{$user->name}}" id="nombreInput" disabled></td>
                        <td><a class="btn btn-info" href="#" onclick="enableEdit('nombreInput'); return false;"><i class="fa-solid fa-pencil"></i></a></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            @if ($errors->has('nombre'))
                            <div class="text-danger">{{ $errors->first('nombre') }}</div>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="configColumn">Email</td>
                        <td><input type="email" name="email" value="{{$user->email}}" id="emailInput" disabled></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            @if ($errors->has('email'))
                            <div class="text-danger">{{ $errors->first('email') }}</div>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="configColumn">Telefono</td>
                        <td><input type="number" name="telefono" value="{{$user->telefono}}" id="telefonoInput" disabled></td>
                        <td><a class="btn btn-info" href="#" onclick="enableEdit('telefonoInput'); return false;"><i class="fa-solid fa-pencil"></i></a></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            @if ($errors->has('telefono'))
                            <div class="text-danger">{{ $errors->first('telefono') }}</div>
                            @endif
                        </td>
                    </tr>
                    <tr id="buttonSavePerfil" style="display: none;">
                        <td colspan="3"><a class="btn btn-danger" href="#" onclick="disableEdit(); return false;" style="margin-right: 1rem;">Cancelar</a><button class="btn btn-success" type="submit">Guardar</button></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
    <hr>
    <div>
        <form method="POST" action="{{route('configPasswordUpdate')}}">
            @csrf
            <table>
                <thead>
                    <tr>
                        <th colspan="2">Password</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="configColumn">Vieja contraseña</td>
                        <td><input type="text" name="oldPassword" value=""></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            @if ($errors->has('oldPassword'))
                            <div class="text-danger">{{ $errors->first('oldPassword') }}</div>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="configColumn">Nueva contraseña</td>
                        <td><input type="text" name="newPassword" value=""></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            @if ($errors->has('newPassword'))
                            <div class="text-danger">{{ $errors->first('newPassword') }}</div>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="configColumn">Repetir contraseña</td>
                        <td><input type="text" name="passwordRepeat" value=""></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            @if ($errors->has('passwordRepeat'))
                            <div class="text-danger">{{ $errors->first('passwordRepeat') }}</div>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><button type="submit" class="btn btn-success">Aceptar</button></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
    <hr>
    <div>
        <h1>Suscripción</h1>
        @if($trialDays !== null)
        <p>Periodo de prueba ({{$trialDays}} dias restantes) <i class="fa-solid fa-stopwatch"></i></p>
        @else
        <div class="planCard">
            <p>{{$userPlan->nombre}} <img src="{{$userPlan->image}}"></p>
            <div style="color: green; font-size: 5rem">
                <i class="fa-solid fa-circle-check"></i>
            </div>
        </div>
        @endif
        <a href="{{ route('suscripcion') }}" class="btn btn-info">Solucionar ya!</a>
    </div>
    <hr>
    <div>
        <a href="{{ route('dashboard') }}" class="btn btn-success">volver</a>
    </div>
</div>

<script>
    function enableEdit(inputId) {
        var input = document.getElementById(inputId);
        input.disabled = false;
        document.getElementById('buttonSavePerfil').style.display = 'table-row';
    }

    document.getElementById('perfilForm').addEventListener('submit', function() {
        var inputs = document.querySelectorAll('input[disabled]');
        inputs.forEach(function(input) {
            input.disabled = false;
        });
    });

    function disableEdit() {
        var input1 = document.getElementById('nombreInput');
        var input2 = document.getElementById('emailInput');
        var input3 = document.getElementById('telefonoInput');
        input1.disabled = true;
        input2.disabled = true;
        input3.disabled = true;
        document.getElementById('buttonSavePerfil').style.display = 'none';
    }
</script>
@endsection