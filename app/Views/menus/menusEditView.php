
<?php include("templates/parte1.php");?>
<div class="row">
    <div class="col-12">
 <?= validation_list_errors();
$errors=validation_errors();
?>
        
        <form action="<?php echo baseUrl();?>/menus/actualizar" method="post" enctype="multipart/form-data" id="form1">
        <input type="hidden" class="form-control" id="id" name="id"  value="<?= $datos["id"];?>">    
            
        <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <span id="nombre_error" class="text-danger"></span>
        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?= $datos["nombre"];?>">
        </div>
		<div class="mb-3">
        <label for="tipo_evento" class="form-label">Tipo de evento</label>
        <span id="tipo_evento_error" class="text-danger"></span>
        <input type="text" class="form-control" id="tipo_evento" name="tipo_evento" placeholder="Tipo de evento" value="<?= $datos["tipo_evento"];?>">
        </div><div class="mb-3">
        <label for="descripcion" class="form-label">Descripcion</label>
        <span id="descripcion_error" class="text-danger"></span>
        <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion" value="<?= $datos["descripcion"];?>">
        </div>
		<div class="mb-3">
        <label for="precio" class="form-label">Precio</label>
        <span id="precio_error" class="text-danger"></span>
        <input type="number" class="form-control" id="precio" name="precio" placeholder="Precio" value="<?= $datos["precio"];?>">
        </div>

        <div class="mb-3"> 
        <input type="submit" class="form-control" value="Aceptar" id="btnform11">
        </div>

    </form>
        
         </div>
</div>
<?php include("templates/parte2.php");?>