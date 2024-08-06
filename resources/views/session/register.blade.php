@extends('layouts.mainSinMenu')
@section('title', 'Agenda Web')

@section('content')
<div class="page_3">
    <div class="card-register">
        <form method="POST" action="{{ route('validar-registro') }}">
            @csrf
            @if (session('error'))
            <div class="text-danger">
                {{ session('error') }}
            </div>
            @endif
            <div class="mb-3">
                <label for="userInput" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="userInput" name="name" required autocomplete="off" value="{{ old('name') }}">
                @error('name')
                <small style="color: red;">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="telefonoInput" class="form-label">Telefono</label>
                <input type="text" class="form-control" id="telefonoInput" name="telefono" required autocomplete="off" value="{{ old('telefono') }}">
                @error('telefono')
                <small style="color: red;">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="emailInput" class="form-label">Email</label>
                <input type="email" class="form-control" id="emailInput" name="email" autocomplete="off" value="{{ old('email') }}">
                @error('email')
                <small style="color: red;">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="passwordInput" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="passwordInput" name="password" required>
                <small><br>*Debe contener almenos un simbolo y 8 caracteres.</small>
                @error('password')
                <small style="color: red;">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="passwordRepeatInput" class="form-label">Repetir contraseña</label>
                <input type="password" class="form-control" id="passwordRepeatInput" name="passwordRepeat" required>
                @error('passwordRepeat')
                <small style="color: red;">{{ $message }}</small>
                @enderror
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Registrarse</button><a href="{{ route('login') }}"><br><br>Ya estas registrado?</a>
            </div>
        </form>
    </div>
</div>
@endsection