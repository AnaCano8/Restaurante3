
<?php include("templates/parte1.php");?>
<div class="row">
    <div class="col-12">
 <?= validation_list_errors();
$errors=validation_errors();
?>
        
        <form action="<?php echo baseUrl();?>/salones/actualizar" method="post" enctype="multipart/form-data" id="form1">
        <input type="hidden" class="form-control" id="id" name="id"  value="<?= $datos["id"];?>">    
            
        <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <span id="nombre_error" class="text-danger"></span>
        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?= $datos["nombre"];?>">
        </div>
		<div class="mb-3">
        <label for="capacidad" class="form-label">capacidad</label>
        <span id="capacidad_error" class="text-danger"></span>
        <input type="number" class="form-control" id="capacidad" name="capacidad" placeholder="Capacidad" value="<?= $datos["capacidad"];?>">
        </div>

        <div class="mb-3"> 
        <input type="submit" class="form-control" value="Aceptar" id="btnform11">
        </div>

    </form>
        
         </div>
</div>
<?php include("templates/parte2.php");?>