@extends('layouts.main')
@section('title', 'Agenda Web')

@section('content')
<div class="page_1">
    <a href="{{ route('welcome') }}"><div class="card-welcome text-center">
        <h1>Bienvenido</h1>
        <img src="/img/agenda.webp" id="agenda-design">
    </div></a>
</div>
@endsection