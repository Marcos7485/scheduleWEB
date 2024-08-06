@extends('layouts.main')
@section('title', 'Agenda Web')

@section('content')
<div class="page_2">
    <div class="card-login">
        <form method="POST" action="{{ route('recovery') }}">
            @csrf

            <div class="mb-3">
                <label for="emailInput" class="form-label">Email</label>
                <input type="email" class="form-control" id="emailInput" name="email" value="{{ old('email') }}" required>
            </div>

            @if ($errors->has('email'))
            <div class="text-danger">{{ $errors->first('email') }}</div>
            @endif

            @if (session('message'))
            <div class="text-success">
                {{ session('message') }} <i class="fa-solid fa-circle-check"></i>
            </div>
            @endif

            @if (session('error'))
            <div class="text-danger">
                {{ session('error') }}
            </div>
            @endif

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Recuperar cuenta</button>
            </div>
        </form>
    </div>
</div>
@endsection