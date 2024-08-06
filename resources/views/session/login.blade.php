@extends('layouts.main')
@section('title', 'Agenda Web')

@section('content')
<div class="page_2">
    <div class="card-login">
        <form method="POST" action="{{ route('inicia-sesion') }}">
            @csrf
            <div class="mb-3">
                <label for="emailInput" class="form-label">Email</label>
                <input type="email" class="form-control" id="emailInput" name="email" value="{{ old('email') }}">
            </div>

            <div class="mb-3">
                <label for="passwordInput" class="form-label">Password</label>
                <input type="password" class="form-control" id="passwordInput" name="password">
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="rememberCheck" name="remember">
                <label class="form-check-label" for="rememberCheck">Mantener sesion iniciada</label>
            </div>
            @error('error')
            <small style="color: red;">{{ $message }}</small>
            @enderror
            <div>
                <p>Olvidaste tu contraseña? <a href="{{ route('recuperar.password') }}">Recuperar cuenta</a></p>
                <p>No tenes cuenta? <a href="{{ route('registro') }}">Registrate</a></p>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Acceder</button>
            </div>
        </form>
    </div>
</div>
@endsection