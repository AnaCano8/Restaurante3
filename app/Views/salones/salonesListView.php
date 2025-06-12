
<?php include("templates/parte1.php");?>
<div class="row">
    <div class="col-12">

        
        <table class="table datatable" id="tabla">
          <thead>
    <tr>
        <th>Id</th> 
        <th>Nombre</th>
		<th>Capacidad</th>
        <?php if (session('role') === 'Administrador'): ?>
		<th>Acciones</th>
		<?php endif; ?>
   </tr>
              </thead>
          <tbody>
        <?php
        
        
         if(count($salones)>0){
             foreach($salones as $s){
                 ?>
                    <tr>
                    <td><?php echo $s["id"];?></td> 
                    <td><?php echo $s["nombre"];?></td>
					<td><?php echo $s["capacidad"];?></td>
					<td><?php if (session('role') === 'Administrador'): ?><a href="<?php echo baseUrl();?>/salones/editar?id=<?php echo $s["id"];?>"><i class="fa-solid fa-pen-to-square fa-2
                        x"></i></a>
                    &nbsp;&nbsp;
                     <a href="<?php echo baseUrl();?>/salones/eliminar?id=<?php echo $s["id"];?>" data-id="<?php echo $s["id"];?>" class="borrar"><i class="fa-solid fa-trash text-danger"></i>;        
                </a>  <?php endif; ?>  
                    </td>
                    </tr>
                <?php
                 
                 
             }
         }
        ?>
          </tbody>
          <tfooter>
    <tr>
        <th>Id</th> 
        <th>Nombre</th>
		<th>Capacidad</th>
        <?php if (session('role') === 'Administrador'): ?>
		<th>Acciones</th>
		<?php endif; ?>
    </tr>
              </tfooter>
    </table>
        
         </div>
</div>
<?php include("templates/parte2.php");?>