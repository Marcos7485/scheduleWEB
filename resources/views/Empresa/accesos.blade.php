@extends('layouts.main')
@section('title', 'Agenda Web')

@section('content')
<div class="page_trabajadores text-center">
    <div class="trabajadores-menu">
        <div>
            <h1>Accesos</h1>
        </div>
        @foreach($trabajadores as $trabajador)
        <div class="lineTrabajador">
            <a href="{{ route('trabajador.acceso', $trabajador->id) }}">
                <div>
                    <h1>{{ $trabajador->nombre }} <i class="fa-solid fa-network-wired"></i></h1>

                </div>
            </a>
        </div>
        @endforeach
        <a href="{{ route('empresa') }}" class="btn btn-success">volver</a>
    </div>
</div>
@endsection