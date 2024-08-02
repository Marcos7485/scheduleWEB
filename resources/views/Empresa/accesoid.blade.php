@extends('layouts.main')
@section('title', 'Agenda Web')

@section('content')
<div class="accesospage text-center">
    <div class="darPageAll">
        <small id="idmensaje" style="color: green;"></small>
        <div>
            <h1>Acceso web:</h1>
        </div>

        <div class="card-link">
            <div class="input-text">
                <input type="text" id="linkInput" value="{{ $link }}" style="padding: 5px;" disabled><button class="btn btn-info" onclick="copyToClipboard()"><i class="fa-solid fa-copy"></i></button>
            </div>
        </div>

        <div>
            <h1>Password:</h1>
        </div>

        <div class="card-link">
            <div class="input-text">
                <input type="text" id="passwordInput" value="{{ $password }}" style="padding: 5px;" disabled><button class="btn btn-info" onclick="copyToClipboardPassword()"><i class="fa-solid fa-copy"></i></button>
            </div>
        </div>

        <div>
            <a href="{{ route('accesos') }}" class="btn btn-success">volver</a>
        </div>
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