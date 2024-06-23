@extends('layouts.main')
@section('title', 'Agenda Web')

@section('content')
<div class="pageturnos text-center">
    <div>
        <h1>Turnos Hoy: {{ $hoy }}</h1>

        <table id="turnos-hoy">
            <thead>
                <tr>
                    <th>Hora</th>
                    <th>Cliente</th>
                    <th>Contacto</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < count($turnos); $i++) <tr>
                    <td>{{$turnos[$i]['hora']}}</td>
                    <td>{{ $clientes[$i]->nombre }}</td>
                    <td><a href="https://wa.me/54{{ $clientes[$i]->telefono }}"  style="text-decoration: none;">{{ $clientes[$i]->telefono }}&nbsp;<i class="fa-brands fa-whatsapp"></i></a></td>
                    @if ($turnos[$i]['status'] == 'PENDIENTE')
                    <td style="color:green;">{{ $turnos[$i]['status'] }}</td>
                    @else
                    <td style="color:red">{{ $turnos[$i]['status'] }}</td>
                    @endif
                    </tr>
                    @endfor
            </tbody>
        </table>
        <a href="{{ route('TurnosMenu') }}" class="btn btn-success">volver</a>
    </div>
</div>
@endsection