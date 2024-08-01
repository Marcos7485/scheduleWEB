@extends('layouts.main')
@section('title', 'Agenda Web')

@section('content')
<div class="darturnospage text-center">
    <div class="darPageAll">
        <div>
            <h1>Link de empresa</h1>
        </div>
        <div>
            <form action="{{ route('update-lapsos-turnosEmpresa') }}" method="POST">
                @csrf
                <input type="hidden" value="{{ $empresa->id }}" name="empresaId">
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
            <small id="idmensaje" style="color: green;"></small>
        </div>

        <div class="card-link">
            <div class="input-text">
                <input type="text" id="linkInput" value="{{ $link }}" style="padding: 5px;" disabled><button class="btn btn-info" onclick="copyToClipboard()"><i class="fa-solid fa-copy"></i></button>
            </div>
        </div>


        <div>
            <a href="{{ route('empresa') }}" class="btn btn-success">volver</a>
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
</script>
@endsection