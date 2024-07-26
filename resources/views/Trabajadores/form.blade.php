@extends('layouts.main')
@section('title', 'Agenda Web')

@section('content')
<div class="formTrabajadores">
    <div class="card-register text-center">
        <form method="POST" action="{{ route('crearTrabajador') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nombreInput" class="form-label">Nombre del trabajador</label>
                <input type="text" class="form-control" id="userInput" name="nombre" autocomplete="off" value="{{ old('name') }}" required>
                @error('name')
                <small style="color: red;">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="imageInput" class="form-label">Imagen de perfil (opcional)</label>
                <input type="file" class="form-control" id="imageInput" name="image" onchange="previewImage(event)">
                @error('image')
                <small style="color: red;">{{ $message }}</small>
                @enderror
                <img id="imagePreview" src="" alt="Vista previa de la imagen" style="width: 100px; display: none; margin: auto; margin-top: 15px;">
            </div>
            <div class="mb-3">
                <label for="telefonoInput" class="form-label">Telefono</label>
                <input type="text" class="form-control" id="telefonoInput" name="telefono" autocomplete="off" value="{{ old('telefono') }}" required>
                @error('telefono')
                <small style="color: red;">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="backgroundInput" class="form-label">Imagen de fondo (opcional)</label>
                <input type="file" class="form-control" id="backgroundInput" name="background" onchange="previewBackgroundImage(event)">
                @error('image')
                <small style="color: red;">{{ $message }}</small>
                @enderror
                <img id="backgroundPreview" src="" alt="Vista previa de la imagen">
            </div>
            <div class="mb-3">
                <label for="fraseInput" class="form-label">Frase única (opcional)</label>
                <input type="text" class="form-control" id="userInput" name="frase" autocomplete="off" value="{{ old('frase') }}">
                @error('name')
                <small style="color: red;">{{ $message }}</small>
                @enderror
            </div>
            <div class="text-center">
            <a href="{{ route('trabajadores') }}" class="btn btn-success">volver</a>
                <button type="submit" class="btn btn-primary">Crear Trabajador</button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(event) {
        var file = event.target.files[0];
        var reader = new FileReader();
        var img = new Image();

        var errorElement = document.getElementById('imageError');
        var preview = document.getElementById('imagePreview');

        if (file) {
            reader.onload = function(e) {
                img.src = e.target.result;
                img.onload = function() {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
            }
            reader.readAsDataURL(file);
        }
    }

    function previewBackgroundImage(event) {
        var file = event.target.files[0];
        var reader = new FileReader();
        var img = new Image();

        var errorElement = document.getElementById('imageError');
        var preview = document.getElementById('backgroundPreview');

        if (file) {
            reader.onload = function(e) {
                img.src = e.target.result;
                img.onload = function() {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
            }
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection