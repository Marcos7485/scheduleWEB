@extends('layouts.main')
@section('title', 'Agenda Web')

@section('content')
<div class="suscripcionPage">
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
                <p class="PlanValor">${{$plan->valor}}/mes</p>
                @if(isset($userPlan->id) && $userPlan->id == $plan->id)
                <a class="btn btn-info" disabled>Contratado!</a>
                @else
                <a href="{{ route('suscripcion-selected', $plan->id) }}" class="btn btn-success">Suscribirse!</a>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    <div>
        <a href="{{ route('welcome') }}" class="btn btn-success">volver</a>
    </div>
</div>
@endsection