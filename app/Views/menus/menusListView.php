
<?php include("templates/parte1.php");?>
<div class="row">
    <div class="col-12">

        
        <table class="table datatable" id="tabla">
          <thead>
    <tr>
        <th>Id</th> 
        <th>Nombre</th>
		<th>Tipo de evento</th>
		<th>Descripcion</th>
		<th>Precio</th>
        <?php if (session('role') === 'Administrador'): ?>
		<th>Acciones</th>
		<?php endif; ?>
   </tr>
              </thead>
          <tbody>
        <?php
        
        
         if(count($menus)>0){
             foreach($menus as $m){
                 ?>
                    <tr>
                    <td><?php echo $m["id"];?></td> 
                    <td><?php echo $m["nombre"];?></td>
                    <td><?php echo $m["tipo_evento"];?></td>
					<td><?php echo $m["descripcion"];?></td>
					<td><?php echo $m["precio"];?></td>
					<td><?php if (session('role') === 'Administrador'): ?><a href="<?php echo baseUrl();?>/menus/editar?id=<?php echo $m["id"];?>"><i class="fa-solid fa-pen-to-square fa-2
                        x"></i></a>
                    &nbsp;&nbsp;
                     <a href="<?php echo baseUrl();?>/menus/eliminar?id=<?php echo $m["id"];?>" data-id="<?php echo $m["id"];?>" class="borrar"><i class="fa-solid fa-trash text-danger"></i>;        
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
		<th>Tipo de Evento</th>
		<th>Descripcion</th>
		<th>Precio</th>
        <?php if (session('role') === 'Administrador'): ?>
		<th>Acciones</th>
		<?php endif; ?>
    </tr>
              </tfooter>
    </table>
        
         </div>
</div>
<?php include("templates/parte2.php");?>