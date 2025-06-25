@extends('layouts.app')
@section('content')

  <div class="container">

    <div id="agenda"></div>

  </div>

  <!-- button trigger modal -->


  <!-- Modal -->
  <div class="modal fade" id="evento" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content shadow-lg border-0 rounded-4">
      <div class="modal-header bg-primary text-white rounded-top-4">
      <h5 class="modal-title" id="modalLabel">🗓️ Datos del Evento</h5>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <div class="modal-body bg-light">

      <form action="" id="formularioEventos">
        @csrf

        <input type="hidden" name="id" id="id">

        <div class="mb-3">
        <label for="title" class="form-label fw-bold">📌 Título</label>
        <input type="text" class="form-control shadow-sm" name="title" id="title" placeholder="Escribe el título"
          required>
        </div>

        <div class="mb-3">
        <label for="descripcion" class="form-label fw-bold">📝 Descripción</label>
        <textarea class="form-control shadow-sm" name="descripcion" id="descripcion" rows="3"
          placeholder="Agrega una descripción..."></textarea>
        </div>
        <div class="mb-3">
        <label for="start" class="form-label">Inicio</label>
        <input type="datetime-local" class="form-control" name="start" id="start" required>
        </div>

        <div class="mb-3">
        <label for="end" class="form-label">Finalización</label>
        <input type="datetime-local" class="form-control" name="end" id="end" required>
        </div>

      </form>

      </div>

      <div class="modal-footer bg-white rounded-bottom-4 d-flex justify-content-between">
      <button type="button" class="btn btn-success shadow-sm" id="btnGuardar">💾 Guardar</button>
      <button type="button" class="btn btn-warning text-white shadow-sm" id="btnModificar">✏️ Modificar</button>
      <button type="button" class="btn btn-danger shadow-sm" id="btnEliminar">🗑️ Eliminar</button>
      </div>
    </div>
    </div>
  </div>
  
    <script src="{{ asset('js/agenda.js') }}"></script>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


@endsection