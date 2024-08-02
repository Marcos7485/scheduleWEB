@extends('layouts.mainSinMenu')
@section('title', 'Agenda Web')

@section('content')
<div class="page_4 text-center">
    <div class="dashboard-menu-turnos">
        <p>Turnos de {{ $trabajador->nombre }}</p>
        <a href="{{ route('turnosHoyTrabajador', ['id' => $trabajador->id]) }}">
            <div>
                <h1>Hoy</h1>
                <img src="">
            </div>
        </a>
        <a href="{{ route('turnosWeekTrabajador', ['id' => $trabajador->id]) }}">
            <div>
                <h1>Esta semana</h1>
                <img src="">
            </div>
        </a>
        <a href="{{ route('turnosNextWeekTrabajador', ['id' => $trabajador->id]) }}">
            <div>
                <h1>Semana próxima</h1>
                <img src="">
            </div>
        </a>
        <a href="{{ route('turnosMonthTrabajador', ['id' => $trabajador->id]) }}">
            <div>
                <h1>Este mes</h1>
                <img src="">
            </div>
        </a>
        <a href="{{ route('turnosAllTrabajador', ['id' => $trabajador->id]) }}">
            <div>
                <h1>Todos</h1>
                <img src="">
            </div>
        </a>
    </div>
</div>
@endsection