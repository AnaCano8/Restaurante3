
<?php include("templates/parte1.php");?>
<div class="row">
    <div class="col-12">

        
        <table class="table datatable" id="tabla">
          <thead>
    <tr>
        <th>Id</th> 
		<th>Usuario</th>
		<th>Accion</th>
		<th>IP</th>
		<th>Fecha</th>

   </tr>
              </thead>
          <tbody>
        <?php
        
        
         if(count($auditorias)>0){
             foreach($auditorias as $a){
                 ?>
                    <tr>
                    <td><?php echo $a["id"];?></td> 
                    <td><?php echo $a["nombre_usuario"];?></td>
					<td><?php echo $a["accion"];?></td>
					<td><?php echo $a["ip"];?></td>
					<td><?php echo $a["fecha"];?></td>
					
                    </tr>
                <?php
                 
                 
             }
         }
        ?>
          </tbody>
          <tfooter>
    <tr>
        <th>Id</th> 
		<th>Usuario</th>
		<th>Accion</th>
		<th>IP</th>
		<th>Fecha</th>
    </tr>
              </tfooter>
    </table>
        
         </div>
</div>
<?php include("templates/parte2.php");?>