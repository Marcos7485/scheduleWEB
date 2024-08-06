@extends('layouts.main')
@section('title', 'Agenda Web')

@section('content')
<div class="page_2">
    <div class="card-login">
        <form method="POST" action="{{ route('update-password') }}">
            @csrf
            <div>
                <input type="hidden" name="id" value="{{$idUser}}">
                <small><br>*Debe contener almenos un simbolo y 8 caracteres.</small>
            </div>
            <div class="mb-3">
                <label for="passwordInput" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="passwordInput" name="password" required>
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

            @if (session('error'))
            <div class="text-danger">
                {{ session('error') }}
            </div>
            @endif

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Actualizar contraseña</button>
            </div>
        </form>
    </div>
</div>
@endsection