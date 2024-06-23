@extends('layouts.main')
@section('title', 'Agenda Web')

@section('content')
<div class="Page_10 text-center">
   <div class="turnosForm">
      <form method="POST" action="{{ route('turnos-create') }}">
         @csrf
         <div class="mb-3">
            <label for="userInput" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="userInput" name="name" required autocomplete="off" value="{{ old('name') }}">
            @error('name')
            <small style="color: red;">{{ $message }}</small>
            @enderror
         </div>
         <div class="mb-3">
            <label for="telefonoInput" class="form-label">Telefono</label>
            <input type="text" class="form-control" id="telefonoInput" name="telefono" required autocomplete="off">
            @error('telefono')
            <small style="color: red;">{{ $message }}</small>
            @enderror
         </div>
         <div class="mb-3">
            <label for="fecha">Selecciona una fecha:</label><br>
            <input class="form-control" type="date" id="fecha" name="fecha">
            @error('fecha')
            <small style="color: red;">{{ $message }}</small>
            @enderror
         </div>
         <div class="mb-3">
            <label for="horario" class="form-label">Horario</label>
            <select class="form-control" id="horario" name="horario" required autocomplete="off" disabled>
               <option>--.--</option>
               @error('horario')
               <small style="color: red;">{{ $message }}</small>
               @enderror
            </select>
         </div>
         <div class="mb-3">
            <a href="{{ route('dashboard') }}" class="btn btn-success">volver</a>
            <button type="submit" class="btn btn-warning">Agendar</button>
      </form>
   </div>
   @if($message)
   <small style="color: green;">{{ $message }}!</small>
   @endif
</div>

<script>
   const fechaInput = document.getElementById('fecha');
   const horarioSelect = document.getElementById('horario');

   fechaInput.addEventListener('change', function() {
      const fecha = fechaInput.value;
      if (fecha) {
         fetch(`/api/horarios?fecha=${fecha}`)
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