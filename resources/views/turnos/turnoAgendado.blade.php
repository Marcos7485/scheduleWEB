@extends('layouts.main')
@section('title', 'Agenda Web')

@section('content')
<div class="LinkCaducado text-center">
    <div>
        <h1>Turno Agendado Correctamente <i class="fa-solid fa-circle-check" style="color:green;"></i></h1>
    </div>
    <div>
        <a href="{{ route('darTurnos') }}" class="btn btn-success">volver</a>
    </div>
</div>
@endsection