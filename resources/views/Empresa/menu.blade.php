@extends('layouts.main')
@section('title', 'Agenda Web')

@section('content')
<div class="page_4 text-center">
    <div class="dashboard-menu">
        <p>Empresa de {{ $empresa->nombre }}!</p>
        <a href="{{ route('darTurnos') }}">
            <div>
                <h1>Plano</h1>
            </div>
        </a>
    </div>
    <div class="buttonsCel text-center">
        <a href="{{ route('dashboard') }}" class="btn btn-success">volver</a>
    </div>
</div>
@endsection