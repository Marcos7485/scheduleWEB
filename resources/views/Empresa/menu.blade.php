@extends('layouts.main')
@section('title', 'Agenda Web')

@section('content')
<div class="page_empresa text-center">
    <div class="empresa-menu">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        @if (session('info'))
        <div class="alert alert-info">
            {{ session('info') }}
        </div>
        @endif


        @if($empresa != null)
        <form id="uploadForm" action="{{ route('empresa.updateImage') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" id="fileInput" name="image" class="hidden-file-input" accept="image/*" style="display:none;">
            <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
            <img src="{{ asset('storage/' . $empresa->image) }}" alt="Imagen de {{ $empresa->nombre }}" class="empresaImgMenu" onclick="document.getElementById('fileInput').click();">
        </form>
        <p>{{ $empresa->nombre }}</p>
        <a href="{{ route('trabajadores') }}">
            <div>
                <h1>Trabajadores</h1>
            </div>
        </a>
        <a href="{{ route('trabajador.disp') }}">
            <div>
                <h1>Disponibilidad</h1>
            </div>
        </a>
        <a href="{{ route('linkEmpresa') }}">
            <div>
                <h1>Link Empresa</h1>
            </div>
        </a>
        <a href="{{ route('TurnosMenuEmpresa') }}">
            <div>
                <h1>Turnos</h1>
            </div>
        </a>
        <a href="{{ route('modificar-turnosEmpresa') }}">
            <div>
                <h1>Cancelar Turnos</h1>
            </div>
        </a>
        <a href="{{ route('accesos') }}">
            <div>
                <h1>Accesos</h1>
            </div>
        </a>
        <a href="{{ route('dashboard') }}" class="btn btn-success">volver</a>
        <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteEmpresa" data-action="{{ route('Empresa.destroy') }}">Eliminar Empresa</a>



        @else
        <a href="{{ route('empresaForm') }}">
            <div>
                <h1>+ Crear empresa</h1>
            </div>
        </a>
        <a href="{{ route('dashboard') }}" class="btn btn-success">volver</a>
        @endif
    </div>
</div>

<!-- Modal de confirmación para borrar -->
<div class="modal fade" id="deleteEmpresa" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que quieres eliminar tu empresa?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('GET')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('fileInput').addEventListener('change', function(event) {
        const file = event.target.files[0];

        if (file) {
            const img = new Image();
            const reader = new FileReader();

            reader.onload = function(e) {
                img.src = e.target.result;
            };

            img.onload = function() {
                if (img.width > 500 || img.height > 500) {
                    alert('La imagen debe ser de máximo 500x500 píxeles.');
                    document.getElementById('fileInput').value = ''; // Limpiar el input file
                } else {
                    document.getElementById('uploadForm').submit();
                }
            };

            reader.readAsDataURL(file);
        }
    });

    var deleteModal = document.getElementById('deleteEmpresa');
    deleteModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget; // Botón que activó el modal
        var actionUrl = button.getAttribute('data-action'); // Obtener la URL desde el atributo data-action

        // Establecer la acción del formulario del modal
        var form = deleteModal.querySelector('#deleteForm');
        form.setAttribute('action', actionUrl);
    });
</script>
@endsection