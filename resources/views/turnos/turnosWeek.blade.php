@extends('layouts.main')
@section('title', 'Agenda Web')

@section('content')
<div class="pageturnos text-center">
    <div>
        <h1>Turnos de la Semana: {{ $diahoy }}, {{ $hoy }}</h1>

        <table id="turnos-week">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Dia</th>
                    <th>Hora</th>
                    <th>Cliente</th>
                    <th>Contacto</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < count($turnos); $i++) <tr>
                    <td>{{$turnos[$i]['fecha']}}</td>
                    <td>{{$turnos[$i]['dianame']}}</td>
                    <td>{{$turnos[$i]['hora']}}hs</td>
                    <td>{{ $clientes[$i]->nombre }}</td>
                    <td><a href="https://wa.me/54{{ $clientes[$i]->telefono }}"  style="text-decoration: none;">{{ $clientes[$i]->telefono }}&nbsp;<i class="fa-brands fa-whatsapp"></i></a></td>
                    <td>{{ $turnos[$i]['status'] }}</td>
                    </tr>
                    @endfor
            </tbody>
        </table>
        <a href="{{ route('TurnosMenu') }}" class="btn btn-success">volver</a>
    </div>
</div>
@endsection