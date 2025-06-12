@extends('layouts.app')
@section('content')

  <div class="container">

    <div id="agenda"></div>

  </div>

  <!-- button trigger modal -->


  <!-- Modal -->
  <div class="modal fade" id="evento" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="modalLabel">Datos del evento</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="cerrar">
      </button>
      </div>
      <div class="modal-body">


      <!-- formulario para agregar recordatorio -->

      <form action="" id="formularioEventos">
        @csrf<!--esto es una llave que permite trabajar c
    on los datos que lleguen, seguridad es un identificador solo guarda los datos de este formulario -->


        <div class="form-group d-none">
        <label for="id">ID:</label>
        <input type="text" class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="">
        <small id="helpId" class="form-text text-muted">help text</small>
        </div>

        <div class="form-group">
        <label for="title">titulo</label>
        <input type="text" class="form-control" name="title" id="title" aria-describedby="helpId"
          placeholder="escribe el titulo">
        <small id="helpId" class="form-text text-muted">help text</small>
        </div>

        <div class="form-group">
        <label for="descripcion">fecha inicio</label>
        <textarea class="form-control" name="descripcion" id="descripcion" rows="3"></textarea>
        </div>

        <div class="form-group d-none ">
        <label for="start">fecha inicio</label>
        <input type="date" class="form-control" name="start" id="start" aria-describedby="helpId"
          placeholder="escribe el titulo">
        <small id="helpId" class="form-text text-muted">help text</small>
        </div>

        <div class="form-group d-none ">
        <label for="end">fecha fin</label>
        <input type="date" class="form-control" name="end" id="end" aria-describedby="helpId"
          placeholder="escribe el titulo">
        <small id="helpId" class="form-text text-muted">help text</small>
        </div>


      </form>


      </div>
      <div class="modal-footer">

      <button type="button" class="btn btn-success" id="btnGuardar">Guardar</button>
      <button type="button" class="btn btn-warning" id="btnModificar">Modificar</button>
      <button type="button" class="btn btn-danger" id="btnEliminar">Eliminar</button>
     <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>-->

      </div>
    </div>
    </div>
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


@endsection