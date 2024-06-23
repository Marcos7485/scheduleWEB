@extends('layouts.main')
@section('title', 'Agenda Web')

@section('content')
<div class="LinkCaducado text-center">
    <div>
        <p>Turno agendado para: {{ $userName }}</p>
        <p>Cliente: {{ $cliente }}</p>
        <p>El dia: {{ $fecha }}</p>
        <p>Horario: {{ $horario }}</p>
    </div>
</div>
@endsection