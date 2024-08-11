@extends('layouts.main')
@section('title', 'Agenda Web')

@section('content')
<div class="mainSection">
    <div class="pasos">
        <img src="{{$plan->image}}" alt="{{$plan->nombre}}">
        <p>{{$plan->nombre}}</p>
    </div>
    <div>
        @if($plan->nombre == 'Plan Basic')
        <a href="https://www.mercadopago.com.ar/subscriptions/checkout?preapproval_plan_id=2c938084910f959d01913eb368e00ee9" class="btn btn-success">Suscribirse ahora! <i class="fa-solid fa-feather"></i>
        </a>
        @elseif ($plan->nombre == 'Plan Premium')
        <a href="https://www.mercadopago.com.ar/subscriptions/checkout?preapproval_plan_id=2c938084910f95b901913eb546f20ee9" class="btn btn-success">Suscribirse ahora! <i class="fa-solid fa-feather"></i>
        </a>
        @endif
    </div>
    <div>
        <h1>Beneficios:</h1>
    </div>

    <div class="section1">
        <div class="item">
            <p><i class="fa-solid fa-star" style="color: goldenrod;"></i> Uso de agenda personal ilimitado</p>
            <img src="/img/planes/img-1-suscripcion.webp" alt="">
            <p>Ya no correra el tiempo de prueba y podras disfrutar de los beneficios libremente para expandir tu empresa con turnos mas organizados!</p>
        </div>
        <div class="item">
            <p><i class="fa-solid fa-star" style="color:goldenrod;"></i> Links personales con horarios personalizados</p>
            <img src="/img/planes/img-2-suscripcion.webp" alt="">
            <p>Generador de links con horarios personalizados, para enviar a tus clientes por WhatsApp y las redes sociales!</p>
        </div>
        <div class="item">
            <p><i class="fa-solid fa-star" style="color: goldenrod;"></i> Link general para redes sociales</p>
            <img src="/img/planes/img-3-suscripcion.webp" alt="">
            <p>Generador de links con horarios personalizados, para colocar en tu pagina web o en tus perfiles de redes sociales!</p>
        </div>
        @if($plan->nombre == 'Plan Premium')
        <div class="item">
            <p><i class="fa-solid fa-star" style="color: goldenrod;"></i> Creación de tu propia empresa</p>
            <img src="/img/planes/img-4-suscripcion.webp" alt="">
            <p>Tenes una empresa? Entonces colocale tu logo, el nombre y registra los turnos con una imagen personalizable adaptada a tu empresa!</p>
        </div>
        <div class="item">
            <p><i class="fa-solid fa-star" style="color: goldenrod;"></i> Creación de tu staff de hasta 4 trabajadores</p>
            <img src="/img/planes/img-5-suscripcion.webp" alt="">
            <p>Cada trabajador de tu empresa puede manejar sus propios turnos!</p>
        </div>
        <div class="item">
            <p><i class="fa-solid fa-star" style="color: goldenrod;"></i> Horarios ajustables a cada trabajador</p>
            <img src="/img/planes/img-6-suscripcion.webp" alt="">
            <p>Cada trabajador de tu empresa puede tener sus propios horarios de trabajo!</p>
        </div>
        <div class="item">
            <p><i class="fa-solid fa-star" style="color: goldenrod;"></i> Presentacion personalizable del trabajador</p>
            <img src="/img/planes/img-7-suscripcion.webp" alt="">
            <p>Cada trabajador de tu empresa puede presentarse de manera personalizada!</p>
        </div>
        <div class="item">
            <p><i class="fa-solid fa-star" style="color: goldenrod;"></i> Link de empresa con trabajadores para redes sociales</p>
            <img src="/img/planes/img-8-suscripcion.webp" alt="">
            <p>Link personalizado de empresa donde pueden elegir tus trabajadores, para sacar turno con ellos!</p>
        </div>
        <div class="item">
            <p><i class="fa-solid fa-star" style="color: goldenrod;"></i> Página de acceso remoto para tus trabajadores</p>
            <img src="/img/planes/img-9-suscripcion.webp" alt="">
            <p>Link de acceso remoto administrado por vos para cada uno de tus trabajadores!</p>
        </div>
        @endif
    </div>
    <div>
    <a href="{{ route('dashboard') }}" class="btn btn-success">volver</a>
    </div>
</div>
@endsection