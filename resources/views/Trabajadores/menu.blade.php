@extends('layouts.main')
@section('title', 'Agenda Web')

@section('content')
<div class="page_trabajadores text-center">
    <div class="trabajadores-menu">
        @if (session('info'))
        <div class="alert alert-info">
            {{ session('info') }}
        </div>
        @endif

        <h1>Trabajadores</h1>

        @foreach($trabajadores as $trabajador)
        <div class="lineTrabajador">
            <a href="{{ route('trabajador.details', $trabajador->id) }}">
                <div>
                    <h1>{{ $trabajador->nombre }} <i class="fa-solid fa-magnifying-glass"></i></h1>

                </div>
            </a>
            <a href="#" data-bs-toggle="modal" data-bs-target="#deleteTrabajador" data-action="{{ route('trabajador.destroy', $trabajador->id) }}">
                <button class="btn btn-danger"><i class="fa-solid fa-circle-xmark"></i></button>
            </a>
        </div>
        @endforeach
        @if(count($trabajadores) >= 0 && count($trabajadores) < 4) <a href="{{ route('formTrabajador') }}">
            <div>
                <h1>+ Crear trabajador</h1>
            </div>
            </a>
            @endif
            <a href="{{ route('empresa') }}" class="btn btn-success">volver</a>
    </div>
</div>


<!-- Modal de confirmación para borrar -->
<div class="modal fade" id="deleteTrabajador" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que quieres eliminar el trabajador?
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
    var deleteModal = document.getElementById('deleteTrabajador');
    deleteModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget; // Botón que activó el modal
        var actionUrl = button.getAttribute('data-action'); // Obtener la URL desde el atributo data-action

        // Establecer la acción del formulario del modal
        var form = deleteModal.querySelector('#deleteForm');
        form.setAttribute('action', actionUrl);
    });
</script>

@endsection