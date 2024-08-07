@extends('layouts.main')
@section('title', 'Agenda Web')

@section('content')
<div class="suscripcionPage">
    <div>
        <h1>Tu plan activo</h1>
    </div>
    <div class="suscripcionActiva">
        <p>Periodo de prueba (26 dias restantes) <i class="fa-solid fa-stopwatch"></i></p>
    </div>
    <div>
        <h1>Planes de Suscripción</h1>
    </div>
    <div class="Planes">
        @foreach ($planes as $plan)
        <div class="planColumn">
            <div class="PlanImage">
                <img src="{{$plan->image}}" alt="">
                <p class="planTitle"><i class="fa-brands fa-d-and-d"></i> {{$plan->nombre}}</p>
            </div>
            <div class="PlanDescripcion">
                <p>{!! $plan->descripcion !!}</p>
            </div>
            <div>
                <p class="PlanValor">{{$plan->valor}}</p>
                <a href="{{$plan->id}}" class="btn btn-success">Suscribirse!</a>
            </div>
        </div>
        @endforeach
    </div>
    <div>
        <a href="{{ route('dashboard') }}" class="btn btn-success">volver</a>
    </div>
</div>
@endsection