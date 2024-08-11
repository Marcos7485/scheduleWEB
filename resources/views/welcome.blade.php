@extends('layouts.main')
@section('title', 'Agenda Web')

@section('content')
<div class="page_1">
    <a href="{{ route('dashboard') }}">
        <div class="card-welcome text-center">
            <h1>Bienvenido</h1>
        </div>
    </a>
    <a href="https://www.dragonrojosoftware.online/">
        <div>
            <img src="/img/drs.png" alt="">
        </div>
    </a>
</div>
@endsection