@extends('layouts.main')
@section('title', 'Agenda Web')

@section('content')
<div class="darturnospage text-center">
    <div class="darPageAll">
        <div>
            <small id="idmensaje" style="color: green;"></small>
        </div>

        <div>
            <form action="{{ route('update-lapsos-turnos') }}" method="POST">
                @csrf
                <small>Turnos de (minutos): <select name="lapsos">
                        <option>{{$lapsos}}</option>
                        @if ($lapsos == '30')
                        <option>60</option>
                        <option>90</option>
                        <option>120</option>
                        @elseif ($lapsos == '60')
                        <option>30</option>
                        <option>90</option>
                        <option>120</option>
                        @elseif ($lapsos == '90')
                        <option>30</option>
                        <option>60</option>
                        <option>120</option>
                        @elseif ($lapsos == '120')
                        <option>30</option>
                        <option>60</option>
                        <option>90</option>
                        @endif
                    </select></small>

                <button type="submit" class="btn btn-warning"><i class="fa-solid fa-circle-left"></i>&nbsp;<small>Establecer</small></button>
            </form>
        </div>
        <div>
            <button class="btn btn-light" id="generateButton"><i class="fa-solid fa-arrows-rotate"></i><br><small>Turno establecido de {{$lapsos}} minutos</small></button>
        </div>

        <div class="card-link">
            <div class="input-text">
                <input type="text" id="linkInput" value="{{ $link }}" style="padding: 5px;" disabled><button class="btn btn-info" onclick="copyToClipboard()"><i class="fa-solid fa-copy"></i></button>
            </div>
        </div>


        <div>
            <a href="{{ route('dashboard') }}" class="btn btn-success">volver</a>
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