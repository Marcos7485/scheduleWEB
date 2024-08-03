@extends('layouts.main')
@section('title', 'Agenda Web')

@section('content')

<div class="page_5">
    <div>
        <h1>Horario de atención</h1>

        <section class="movies">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <h1>Lunes</h1>
                        @if(json_decode($info->lunes) !== "Cerrado")
                        <p class="btn btn-success">Abierto</p>
                        @else
                        <p class="btn btn-danger" disabled>Cerrado</p>
                        @endif
                        <h1>Apertura</h1>
                        @if(json_decode($info->lunes) !== "Cerrado")
                        <p>{{$lunes[0]}}:{{$lunes[1]}}</p>
                        @else
                        <p> --.-- </p>
                        @endif
                        <h1>Cierre</h1>
                        @if(json_decode($info->lunes) !== 'Cerrado')
                        <p>{{$lunes[2]}}:{{$lunes[3]}}</p>
                        @else
                        <p> --.-- </p>
                        @endif
                    </div>
                    <div class="swiper-slide">
                        <h1>Martes</h1>
                        @if(json_decode($info->martes) !== "Cerrado")
                        <p class="btn btn-success">Abierto</p>
                        @else
                        <p class="btn btn-danger" disabled>Cerrado</p>
                        @endif
                        <h1>Apertura</h1>
                        @if(json_decode($info->martes) !== "Cerrado")
                        <p>{{$martes[0]}}:{{$martes[1]}}</p>
                        @else
                        <p> --.-- </p>
                        @endif
                        <h1>Cierre</h1>
                        @if(json_decode($info->martes) !== 'Cerrado')
                        <p>{{$martes[2]}}:{{$martes[3]}}</p>
                        @else
                        <p> --.-- </p>
                        @endif
                    </div>
                    <div class="swiper-slide">
                        <h1>Miercoles</h1>
                        @if(json_decode($info->miercoles) !== "Cerrado")
                        <p class="btn btn-success">Abierto</p>
                        @else
                        <p class="btn btn-danger" disabled>Cerrado</p>
                        @endif
                        <h1>Apertura</h1>
                        @if(json_decode($info->miercoles) !== "Cerrado")
                        <p>{{$miercoles[0]}}:{{$miercoles[1]}}</p>
                        @else
                        <p> --.-- </p>
                        @endif
                        <h1>Cierre</h1>
                        @if(json_decode($info->miercoles) !== 'Cerrado')
                        <p>{{$miercoles[2]}}:{{$miercoles[3]}}</p>
                        @else
                        <p> --.-- </p>
                        @endif
                    </div>
                    <div class="swiper-slide">
                        <h1>Jueves</h1>
                        @if(json_decode($info->jueves) !== "Cerrado")
                        <p class="btn btn-success">Abierto</p>
                        @else
                        <p class="btn btn-danger" disabled>Cerrado</p>
                        @endif
                        <h1>Apertura</h1>
                        @if(json_decode($info->jueves) !== "Cerrado")
                        <p>{{$jueves[0]}}:{{$jueves[1]}}</p>
                        @else
                        <p> --.-- </p>
                        @endif
                        <h1>Cierre</h1>
                        @if(json_decode($info->jueves) !== 'Cerrado')
                        <p>{{$jueves[2]}}:{{$jueves[3]}}</p>
                        @else
                        <p> --.-- </p>
                        @endif
                    </div>
                    <div class="swiper-slide">
                        <h1>Viernes</h1>
                        @if(json_decode($info->viernes) !== "Cerrado")
                        <p class="btn btn-success">Abierto</p>
                        @else
                        <p class="btn btn-danger" disabled>Cerrado</p>
                        @endif
                        <h1>Apertura</h1>
                        @if(json_decode($info->viernes) !== "Cerrado")
                        <p>{{$viernes[0]}}:{{$viernes[1]}}</p>
                        @else
                        <p> --.-- </p>
                        @endif
                        <h1>Cierre</h1>
                        @if(json_decode($info->viernes) !== 'Cerrado')
                        <p>{{$viernes[2]}}:{{$viernes[3]}}</p>
                        @else
                        <p> --.-- </p>
                        @endif
                    </div>
                    <div class="swiper-slide">
                        <h1>Sabado</h1>
                        @if(json_decode($info->sabado) !== "Cerrado")
                        <p class="btn btn-success">Abierto</p>
                        @else
                        <p class="btn btn-danger" disabled>Cerrado</p>
                        @endif
                        <h1>Apertura</h1>
                        @if(json_decode($info->sabado) !== "Cerrado")
                        <p>{{$sabado[0]}}:{{$sabado[1]}}</p>
                        @else
                        <p> --.-- </p>
                        @endif
                        <h1>Cierre</h1>
                        @if(json_decode($info->sabado) !== 'Cerrado')
                        <p>{{$sabado[2]}}:{{$sabado[3]}}</p>
                        @else
                        <p> --.-- </p>
                        @endif
                    </div>
                    <div class="swiper-slide">
                        <h1>Domingo</h1>
                        @if(json_decode($info->domingo) !== "Cerrado")
                        <p class="btn btn-success">Abierto</p>
                        @else
                        <p class="btn btn-danger" disabled>Cerrado</p>
                        @endif
                        <h1>Apertura</h1>
                        @if(json_decode($info->domingo) !== "Cerrado")
                        <p>{{$domingo[0]}}:{{$domingo[1]}}</p>
                        @else
                        <p> --.-- </p>
                        @endif
                        <h1>Cierre</h1>
                        @if(json_decode($info->domingo) !== 'Cerrado')
                        <p>{{$domingo[2]}}:{{$domingo[3]}}</p>
                        @else
                        <p> --.-- </p>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <div>
            <h1>Turnos de cada: {{ $lapsos }} minutos.</h1>
        </div>
        <div class="text-center">
            <a href="{{ route('dashboard') }}" class="btn btn-success">volver</a>
            <a href="{{ route('disp-horaria-edit') }}"><button class="btn btn-warning">Modificar &nbsp;<i class="fa-solid fa-pen-to-square"></i></button></a>
        </div>
    </div>
</div>
@endsection