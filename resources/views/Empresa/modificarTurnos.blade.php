@extends('layouts.main')
@section('title', 'Agenda Web')

@section('content')
<div class="modificarTurnos">
  @if(isset($turnos) && count($turnos) > 0)
  <div class="text-center">
    <h1>Cancelar Turnos</h1>
    @if (session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
    @endif
    <table id="turnos-delete">
      <thead>
        <tr>
          <th>Dia</th>
          <th>Hora</th>
          <th>Cliente</th>
          <th>Trabajador</th>
          <th>Cancelar</th>
        </tr>
      </thead>
      <tbody>
        @for ($i = 0; $i < count($turnos); $i++) <tr style="{{ $turnos[$i]['status'] == 'FINALIZADO' ? 'background-color:brown;' : '' }}">
          <td>{{$turnos[$i]['fecha']}}</td>
          <td>{{$turnos[$i]['hora']}}</td>
          <td>{{$turnos[$i]['cliente']->nombre}}</td>
          <td>{{$turnos[$i]['usuario']->nombre}}</td>
          <td>
            <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-action="{{ route('turnos.destroyEmpresa', $turnos[$i]['id']) }}">
              <i class="fa-solid fa-circle-xmark"></i>
            </a>
          </td>
          </tr>
          @endfor
      </tbody>
    </table>
    <a href="{{ route('empresa') }}" class="btn btn-success">Volver</a>
  </div>
  @elseif(isset($message))
  <div class="message text-center">
    <h1>{{ $message }}</h1>
    <a href="{{ route('empresa') }}" class="btn btn-success">Volver</a>
  </div>
  @endif
</div>

<!-- Modal de confirmación para borrar -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirmar Eliminación</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Estás seguro de que quieres eliminar este turno?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <form id="deleteForm" method="POST" action="">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
      </div>
    </div>
  </div>
</div>


<script>
  var deleteModal = document.getElementById('deleteModal');
  deleteModal.addEventListener('show.bs.modal', function(event) {
    var button = event.relatedTarget; // Botón que activó el modal
    var actionUrl = button.getAttribute('data-action'); // Obtener la URL desde el atributo data-action

    // Establecer la acción del formulario del modal
    var form = deleteModal.querySelector('#deleteForm');
    form.setAttribute('action', actionUrl);
  });
</script>
@endsection