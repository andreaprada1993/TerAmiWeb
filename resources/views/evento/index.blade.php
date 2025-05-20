@extends('layouts.app')
@section('content')

<div class="container">

<h1>hola</h1>
<div id="agenda"></div>

</div>

<!-- button trigger modal -->

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#evento">
  Abrir modal
</button>

    

<!-- Modal -->
<div class="modal fade" id="evento" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Título del Modal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


      <!-- formulario para agregar recordatorio --> 

<form action="">

{!! csrf_field()!!} <!--esto es una llave que permite trabajar con los datos que lleguen, seguridad es un identificador solo guarda los datos de este formulario --> 

  <div class="form-group">
    <label for="id">ID:</label>
    <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
    <small id="helpId" class="form-text text-muted">help text</small>

 
  <div class="form-group">
    <label for="title">titulo</label>
    <input type="text" class="form-control" name="title" id="title" aria-describedby="helpId" placeholder="escribe el titulo">
    <small id="helpId" class="form-text text-muted">help text</small>
  </div>
  
  <div class="form-group">
    <label for="descripcion">fecha inicio</label>
    <textarea class="form-control" name="descripcion" id="descripcion" rows="3"></textarea>
  </div>

  <div class="form-group">
    <label for="start">fecha inicio</label>
    <input type="datetime-local" class="form-control" name="start" id="start" aria-describedby="helpId" placeholder="escribe el titulo">
    <small id="helpId" class="form-text text-muted">help text</small>
  </div>
  <div class="form-group">
    <label for="end">fecha fin</label>
    <input type="datetime-local" class="form-control" name="end" id="end" aria-describedby="helpId" placeholder="escribe el titulo">
    <small id="helpId" class="form-text text-muted">help text</small>
  </div>


</form>


      </div>
      <div class="modal-footer">

      <button type="button" class="btn btn-primary" id="btnGuardar">Guardar</button>
      <button type="button" class="btn btn-primary" id="btnModificar">Modificar</button>
      <button type="button" class="btn btn-primary" ide="btnEliminar">Eliminar</button>


        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>




@endsection