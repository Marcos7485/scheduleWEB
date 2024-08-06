@extends('layouts.mainSinMenu')
@section('title', 'Agenda Web')

@section('content')
<div class="LinkCaducado text-center">
    <div>
        <h3><i class="fa-solid fa-circle-check"></i></h3>
    </div>
    <div>
        <h1>Cuenta validada con exito!</h1>
    </div>
    <div>
        <h4>Ya puede hacer <a href="{{ route('login') }}">login</a></h4>
    </div>
</div>
@endsection