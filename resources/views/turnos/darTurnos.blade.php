@extends('layouts.main')
@section('title', 'Agenda Web')

@section('content')
<div class="darturnospage text-center">
    <div class="darPageAll">
        <div>
            <small id="idmensaje" style="color: green;"></small>
        </div>

        <div>
            <button class="btn btn-light" id="generateButton"><i class="fa-solid fa-arrows-rotate"></i></button>
        </div>

        <div>
            <small>Sus turnos estan establecidos en {{ $lapsos }} minutos.</small>
        </div>

        <div class="card-link">
            <div class="input-text">
                <input type="text" id="linkInput" value="{{ $link }}" style="padding: 5px;" disabled><button class="btn btn-info" onclick="copyToClipboard()"><i class="fa-solid fa-copy"></i></button>
            </div>
        </div>


        <div>
            <a href="{{ Route('create-turno') }}" class="btn btn-info">Crear Turno<i class="fa-solid fa-pen-to-square"></i></a>
        </div>
    </div>
</div>


<script>
    const generateButton = document.getElementById('generateButton');
    const linkInput = document.getElementById('linkInput');

    generateButton.addEventListener('click', function() {
        const linkValue = linkInput.value;
        const mensajeElement = document.getElementById('idmensaje');

        fetch('/api/hash', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Para la protección CSRF
                },
                body: JSON.stringify({
                    link: linkValue
                })
            })
            .then(response => response.json())
            .then(data => {
                linkInput.value = data.link;
                mensajeElement.innerHTML = 'Generado <i class="fas fa-check-circle"></i>';
            })
            .catch((error) => {
                linkInput.value = 'Error';
            });
    });


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

        // Reiniciar el valor del input
        linkInput.value = '--.--';

        // Mostrar mensaje de éxito en el elemento <small>
        const mensajeElement = document.getElementById('idmensaje');
        mensajeElement.innerHTML = 'Copiado <i class="fas fa-check-circle"></i>';

        // Limpia el mensaje después de unos segundos (opcional)
        setTimeout(() => {
            mensajeElement.innerHTML = '';
        }, 1000); // Después de 3 segundos
    }
</script>
@endsection