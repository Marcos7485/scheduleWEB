@extends('layouts.mainSinMenu')
@section('title', 'Agenda Web')

@section('content')
<div class="createClienteTurno text-center">
   <div class="turnosForm">
      <form method="POST" action="{{ route('turnos-createCliente') }}">
         @csrf
         <div class="mb-3">
            <h1>Turno para {{ $usuarioNombre }}</h1>
            <input type="hidden" value="{{ $usuarioId }}" id="usuarioId" name="usId">
            <input type="hidden" value="{{ $token }}" id="tokenId" name="token">
            <input type="hidden" value="{{ $lapsos }}" name="lapsos">
            <small style="color:red">{{ $message }}</small>
         </div>
         <div class="mb-3">
            <label for="userInput" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="userInput" name="name" required autocomplete="off" value="{{ old('name') }}">
         </div>
         <div class="mb-3">
            <label for="telefonoInput" class="form-label">Telefono</label>
            <input type="text" class="form-control" id="telefonoInput" name="telefono" required autocomplete="off">
         </div>
         <div class="mb-3">
            <label for="fecha">Selecciona una fecha:</label><br>
            <input class="form-control" type="date" id="fecha" name="fecha">
         </div>
         <div class="mb-3">
            <label for="horario" class="form-label">Horario</label>
            <select class="form-control" id="horario" name="horario" required autocomplete="off" disabled>
               <option>--.--</option>
            </select>
         </div>
         <div class="mb-3">
            <a href="{{ route('dashboard') }}" class="btn btn-success">volver</a>
            <button type="submit" class="btn btn-warning">Agendar</button>
         </div>
      </form>
   </div>
</div>

<script>
   const fechaInput = document.getElementById('fecha');
   const horarioSelect = document.getElementById('horario');
   const usuarioIdInput = document.getElementById('usuarioId'); // Cambio de nombre aquí
   const tokenIdInput = document.getElementById('tokenId'); // Cambio de nombre aquí

   const now = new Date();
   const offset = -3 * 60;
   const adjustedDate = new Date(now.getTime() + (offset * 60 * 1000));
   const today = adjustedDate.toISOString().split('T')[0];
   document.getElementById('fecha').setAttribute('min', today);
   
   fechaInput.addEventListener('change', function() {
      const fecha = fechaInput.value;
      const usuarioId = usuarioIdInput.value; // Cambio de nombre aquí
      const tokenId = tokenIdInput.value; // Cambio de nombre aquí

      if (fecha) {
         fetch(`/api/horarioscliente?fecha=${fecha}&usp=${usuarioId}&token=${tokenId}`) // Utilizando usuarioId en lugar de $useridInput
            .then(response => response.json())
            .then(data => {
               horarioSelect.innerHTML = '<option value="">Seleccione un horario</option>';
               data.forEach(horario => {
                  const option = document.createElement('option');
                  option.value = horario;
                  option.textContent = horario;
                  horarioSelect.appendChild(option);
               });
               horarioSelect.disabled = false;
            })
            .catch(error => {
               console.error('Error:', error);
               horarioSelect.disabled = true;
               horarioSelect.innerHTML = '<option value="">No disponible</option>';
            });
      } else {
         horarioSelect.disabled = true;
         horarioSelect.innerHTML = '<option value="">Seleccione una fecha primero</option>';
      }
   });
</script>
@endsection