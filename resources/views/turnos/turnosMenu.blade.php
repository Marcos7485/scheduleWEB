@extends('layouts.main')
@section('title', 'Agenda Web')

@section('content')
<div class="page_4 text-center">
    <div class="dashboard-menu-turnos">
    <p>Turnos menu</p>
        <a href="{{ route('turnosHoy') }}">
            <div>
                <h1>Hoy</h1>
                <img src="">
            </div>
        </a>
        <a href="{{ route('turnosWeek') }}">
            <div>
                <h1>Esta semana</h1>
                <img src="">
            </div>
        </a>
        <a href="{{ route('turnosNextWeek') }}">
            <div>
                <h1>Semana próxima</h1>
                <img src="">
            </div>
        </a>
        <a href="{{ route('turnosMonth') }}">
            <div>
                <h1>Este mes</h1>
                <img src="">
            </div>
        </a>
        <a href="{{ route('turnosAll') }}">
            <div>
                <h1>Todos</h1>
                <img src="">
            </div>
        </a>
        <a href="{{ route('dashboard') }}" class="btn btn-success">volver</a>
    </div>
</div>
@endsection