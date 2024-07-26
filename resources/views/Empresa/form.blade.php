@extends('layouts.main')
@section('title', 'Agenda Web')

@section('content')
<div class="formEmpresa">
    <div class="card-register text-center">
        <form method="POST" action="{{ route('crearEmpresa') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="userInput" class="form-label">Nombre de la Empresa</label>
                <input type="text" class="form-control" id="userInput" name="nombre" autocomplete="off" value="{{ old('name') }}" required>
                @error('name')
                <small style="color: red;">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="imageInput" class="form-label">Logomarca (500x500)</label>
                <input type="file" class="form-control" id="imageInput" name="image" required onchange="previewImage(event)">
                @error('image')
                <small style="color: red;">{{ $message }}</small>
                @enderror
                <p id="imageError" style="color: red; display: none;">La imagen debe ser menor de 500x500 píxeles.</p>
                <img id="imagePreview" src="" alt="Vista previa de la imagen" style="width: 100px; display: none; margin: auto; margin-top: 15px;">
            </div>
            <div class="mb-3">
                <label for="telefonoInput" class="form-label">Telefono</label>
                <input type="text" class="form-control" id="telefonoInput" name="telefono" required autocomplete="off" value="{{ old('telefono') }}">
                @error('telefono')
                <small style="color: red;">{{ $message }}</small>
                @enderror
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Crear Empresa</button>
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
                    if (img.width > 500 || img.height > 500) {
                        errorElement.style.display = 'block';
                        preview.style.display = 'none';
                        document.getElementById('imageInput').value = ''; // Clear the file input
                    } else {
                        errorElement.style.display = 'none';
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    }
                }
            }
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection