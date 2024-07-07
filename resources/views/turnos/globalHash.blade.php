@extends('layouts.main')
@section('title', 'Agenda Web')

@section('content')
<div class="darturnospage text-center">
    <div class="darPageAll">
        <div>
            <small id="idmensaje" style="color: green;"></small>
        </div>

        <div>
            <form action="{{ route('update-lapsos-global') }}" method="POST">
                @csrf
                <small>Turnos de (minutos): <select name="lapsos">
                        <option>{{$lapsos}}</option>
                        @if ($lapsos == '30')
                        <option>60</option>
                        <option>120</option>
                        @elseif ($lapsos == '60')
                        <option>30</option>
                        <option>120</option>
                        @elseif ($lapsos == '120')
                        <option>30</option>
                        <option>60</option>
                        @endif
                    </select></small>

                <button type="submit" class="btn btn-warning"><i class="fa-solid fa-circle-left"></i>&nbsp;<small>Establecer</small></button>
            </form>
        </div>
        <div>
            <button class="btn btn-light"><small>Turno establecido de {{$lapsos}} minutos</small></button>
        </div>
        <div class="card-link">
            <div class="input-text">
                <input type="text" id="linkInputGlobal" value="{{ $link }}" style="padding: 5px;" disabled><button class="btn btn-info" onclick="copyToClipboard()"><i class="fa-solid fa-copy"></i></button>
            </div>
        </div>

        <div>
            <a href="{{ route('dashboard') }}" class="btn btn-success">volver</a>
        </div>
    </div>
</div>

<script>
    function copyToClipboard() {
        // Seleccionar el input
        const linkInput = document.getElementById('linkInputGlobal');

        // Guardar el valor actual del input
        const originalValue = linkInput.value;

        // Copiar el texto al portapapeles usando navigator.clipboard
        navigator.clipboard.writeText(originalValue).then(function() {
            // Mostrar una notificación (opcional)
            alert("Copied the text: " + originalValue);
        }).catch(function(error) {
            console.error("Error copying text: ", error);
        });
    }
</script>
@endsection