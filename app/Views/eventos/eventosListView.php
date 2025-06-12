<?php include("templates/parte1.php"); ?>
<div class="row">
    <div class="col-12">

        <h2 class="mb-4">Listado de Eventos</h2>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <table class="table datatable" id="tabla">
            <thead class="table">
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Salón</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Empleado</th>
                    <th>Estado</th>
                    <th>Total (€)</th>
                    <th>Menús</th>
                    <?php if (session('role') === 'Administrador'): ?>
                        <th>Acciones</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($eventos)): ?>
                    <?php foreach ($eventos as $evento): ?>
                        <tr>
                            <td><?= esc($evento['id']) ?></td>
                            <td><?= esc($evento['cliente_nombre'] . ' ' . $evento['cliente_apellido']) ?></td>
                            <td><?= esc($evento['salon_nombre']) ?></td>
                            <td><?= esc($evento['fecha_evento']) ?></td>
                            <td><?= esc($evento['hora_inicio']) ?> - <?= esc($evento['hora_fin']) ?></td>
                            <td><?= esc($evento['empleado']) ?></td>
                            <td><?= esc($evento['estado']) ?></td>
                            <td><?= number_format($evento['total'], 2) ?></td>
                            <td>
                                <ul class="list-unstyled">
                                    <?php foreach ($evento['menus'] as $menu): ?>
                                        <li><?= esc($menu['nombre']) ?> x <?= esc($menu['cantidad']) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </td>
                            <?php if (session('role') === 'Administrador'): ?>
                                <td>
                                    <a href="<?= base_url("eventos/editar/{$evento['id']}") ?>" class="me-2">
                                        <i class="fa-solid fa-pen-to-square fa-lg"></i>
                                    </a>
                                    <a href="<?= base_url("eventos/eliminar/{$evento['id']}") ?>" class="borrar">
                                        <i class="fa-solid fa-trash text-danger"></i>
                                    </a>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="<?php echo session('role')==='Administrador'?10:9; ?>" class="text-center">No hay eventos registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <tfoot class="table">
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Salón</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Empleado</th>
                    <th>Estado</th>
                    <th>Total (€)</th>
                    <th>Menús</th>
                    <?php if (session('role') === 'Administrador'): ?>
                        <th>Acciones</th>
                    <?php endif; ?>
                </tr>
            </tfoot>
        </table>

    </div>
</div>
<?php include("templates/parte2.php"); ?>
<script>
        $(".borrar").click(function(){
            let id=$(this).attr('data-id');
            let padre=$(this).parent().parent();
           const swalWithBootstrapButtons = Swal.mixin({
                          customClass: {
                            confirmButton: "btn btn-success",
                            cancelButton: "btn btn-danger"
                          },
                          buttonsStyling: false
                        });
                        swalWithBootstrapButtons.fire({
                          title: "Desea eliminar el evento?",
                          text: "no hay vuelta atrás!",
                          icon: "warning",
                          showCancelButton: true,
                          confirmButtonText: "Si, borrar!",
                          cancelButtonText: "No, mantener!",
                          reverseButtons: true
                        }).then((result) => {
                          if (result.isConfirmed) {
                              
                              $.ajax({
                                     data:{id:id},
                                     method:"POST",
                                     url: "<?php echo baseUrl();?>/eventos/eliminar", 
                                     success: function(result){
                                         if(result==1){
                                            swalWithBootstrapButtons.fire({
                                              title: "Eliminado!",
                                              text: "Uso dado de baja",
                                              icon: "success"
                                            });
                                            padre.hide();
                                         }else{
                                             swalWithBootstrapButtons.fire({
                                              title: "No Eliminado!",
                                              text: "Uso NO dado de baja",
                                              icon: "error"
                                            });
                                         }
                                    }
                                 });

                              
                            
                              
                              
                          } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                          ) {
                         /*   swalWithBootstrapButtons.fire({
                              title: "Cancelled",
                              text: "Your imaginary file is safe :)",
                              icon: "error"
                            });*/
                          }
                        }); 
        });
        
        </script>
