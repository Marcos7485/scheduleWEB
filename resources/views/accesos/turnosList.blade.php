@extends('layouts.mainSinMenu')
@section('title', 'Agenda Web')

@section('content')
<div class="turnoslist">
    @if(isset($turnos) && count($turnos) > 0)
    <div class="text-center">
        <h1>Turnos {{$periodo}}</h1>
        <table id="turnos-list">
            <thead>
                <tr>
                    @if($periodo != 'hoy')
                    <th>Dia</th>
                    @endif
                    <th>Hora</th>
                    <th>Cliente</th>
                    <th>Contacto</th>
                    <th>Trabajador</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < count($turnos); $i++) 
                <tr style="{{ $turnos[$i]['status'] == 'FINALIZADO' ? 'background-color:brown;' : '' }}">
                    @if($periodo != 'hoy')
                    <td>{{$turnos[$i]['fecha']}}</td>
                    @endif
                    <td>{{$turnos[$i]['hora']}}</td>
                    <td>{{$turnos[$i]['cliente']->nombre}}</td>
                    <td><a href="https://wa.me/54{{ $turnos[$i]['cliente']->telefono }}" style="text-decoration: none;"><i class="fa-brands fa-whatsapp"></i></a></td>
                    <td>{{$turnos[$i]['usuario']->nombre}}</td>
                </tr>
                    @endfor
            </tbody>
        </table>
        <a href="{{ route('TurnosMenuTrabajador', ['id' => $idTrabajador, 'hash' => $password]) }}" class="btn btn-success">volver</a>
    </div>
    @elseif(isset($message))

    <div class="message">
        <h1>{{ $message }}</h1>
        <a href="{{ route('TurnosMenuTrabajador', ['id' => $idTrabajador, 'hash' => $password]) }}" class="btn btn-success">volver</a>
    </div>

    @endif
</div>
@endsection