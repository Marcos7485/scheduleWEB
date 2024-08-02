@extends('layouts.main')
@section('title', 'Agenda Web')

@section('content')
<div class="page_4 text-center">
    <div class="dashboard-menu-turnos">
    <p>Turnos menu</p>
        <a href="{{ route('turnosHoyEmpresa') }}">
            <div>
                <h1>Hoy</h1>
                <img src="">
            </div>
        </a>
        <a href="{{ route('turnosWeekEmpresa') }}">
            <div>
                <h1>Esta semana</h1>
                <img src="">
            </div>
        </a>
        <a href="{{ route('turnosNextWeekEmpresa') }}">
            <div>
                <h1>Semana próxima</h1>
                <img src="">
            </div>
        </a>
        <a href="{{ route('turnosMonthEmpresa') }}">
            <div>
                <h1>Este mes</h1>
                <img src="">
            </div>
        </a>
        <a href="{{ route('turnosAllEmpresa') }}">
            <div>
                <h1>Todos</h1>
                <img src="">
            </div>
        </a>
        <a href="{{ route('empresa') }}" class="btn btn-success">volver</a>
    </div>
</div>
@endsection