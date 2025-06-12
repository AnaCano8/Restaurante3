
<?php include("templates/parte1.php");?>
<div class="row">
    <div class="col-12">
 <?= validation_list_errors();
$errors=validation_errors();
?>
        
        <form action="<?php echo baseUrl();?>/menus/crear" method="post" enctype="multipart/form-data" id="form1">
        <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <span id="nombre_error" class="text-danger"></span>
        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
        </div>
		<div class="mb-3">
        <label for="tipo_evento" class="form-label">Tipo de Evento</label>
        <span id="tipo_evento_error" class="text-danger"></span>
        <input type="text" class="form-control" id="tipo_evento" name="tipo_evento" placeholder="Tipo de Evento">
        </div>
		<div class="mb-3">
        <label for="descripcion" class="form-label">Descripcion</label>
        <span id="descripcion_error" class="text-danger"></span>
        <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion">
        </div>
		<div class="mb-3">
        <label for="precio" class="form-label">Precio</label>
        <span id="precio_error" class="text-danger"></span>
        <input type="number" class="form-control" id="precio" name="precio" placeholder="Precio">
        </div>

        <div class="mb-3"> 
        <input type="submit" class="form-control" value="Aceptar" id="btnform11">
        </div>

    </form>
        
         </div>
</div>
<?php include("templates/parte2.php");?>