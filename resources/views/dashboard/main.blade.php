@extends('layouts.main')
@section('title', 'Agenda Web')

@section('content')
<div class="page_4 text-center">
    <div class="dashboard-menu">
        <p>Bienvenido {{ $user->name }}!</p>
        <a href="{{ route('TurnosMenu') }}">
            <div>
                <h1>Turnos</h1>
            </div>
        </a>
        <a href="{{ route('darTurnos') }}">
            <div>
                <h1>Dar Turnos</h1>
            </div>
        </a>
        <a href="{{ route('geral-link') }}">
            <div>
                <h1>Link general</h1>
            </div>
        </a>
        <a href="{{ route('modificar-turnos') }}">
            <div>
                <h1>Cancelar Turnos</h1>
            </div>
        </a>
        <a href="{{ route('disponibilidad') }}">
            <div>
                <h1>Disponibilidad</h1>
            </div>
        </a>
    </div>
</div>
@endsection