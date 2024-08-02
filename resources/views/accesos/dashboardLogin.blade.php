@extends('layouts.mainSinMenu')
@section('title', 'Agenda Web')

@section('content')
<div class="dashboardTrabajador text-center">
    <div>
        <img src="{{ Storage::url($empresa->image) }}" alt="{{ $empresa->nombre }}">
    </div>
    <div>
        <form method="POST" action="{{ route('dashboardLogin.Access') }}">
            @csrf
            <div class="mb-3">
                <label for="passwordInput" class="form-label">Password</label>
                <input type="password" class="form-control" id="passwordInput" name="password" required>
                @if ($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Acceder</button>
            </div>
        </form>
    </div>
</div>


<script>
    function copyToClipboard() {
        // Seleccionar el input
        const linkInput = document.getElementById('linkInput');

        // Guardar el valor actual del input
        const originalValue = linkInput.value;

        // Crear un elemento temporal para copiar el texto
        const tempInput = document.createElement('input');
        tempInput.value = originalValue;
        document.body.appendChild(tempInput);

        // Seleccionar el texto dentro del elemento temporal
        tempInput.select();
        tempInput.setSelectionRange(0, 99999); // Para dispositivos móviles

        // Copiar el texto al portapapeles
        document.execCommand("copy");

        // Remover el elemento temporal
        document.body.removeChild(tempInput);

        // Mostrar una notificación (opcional)
        alert("Copied the text: " + originalValue);

        // Mostrar mensaje de éxito en el elemento <small>
        const mensajeElement = document.getElementById('idmensaje');
        mensajeElement.innerHTML = 'Copiado <i class="fas fa-check-circle"></i>';

    }

    function copyToClipboardPassword() {
        // Seleccionar el input
        const linkInput = document.getElementById('passwordInput');

        // Guardar el valor actual del input
        const originalValue = linkInput.value;

        // Crear un elemento temporal para copiar el texto
        const tempInput = document.createElement('input');
        tempInput.value = originalValue;
        document.body.appendChild(tempInput);

        // Seleccionar el texto dentro del elemento temporal
        tempInput.select();
        tempInput.setSelectionRange(0, 99999); // Para dispositivos móviles

        // Copiar el texto al portapapeles
        document.execCommand("copy");

        // Remover el elemento temporal
        document.body.removeChild(tempInput);

        // Mostrar una notificación (opcional)
        alert("Copied the text: " + originalValue);

        // Mostrar mensaje de éxito en el elemento <small>
        const mensajeElement = document.getElementById('idmensaje');
        mensajeElement.innerHTML = 'Copiado <i class="fas fa-check-circle"></i>';

    }
</script>
@endsection