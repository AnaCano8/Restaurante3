
<?php include("templates/parte1.php");?>
<div class="row">
    <div class="col-12">

        <h1>Eventos de Hoy (<?= date('Y-m-d') ?>)</h1>

    <?php if (empty($eventos)): ?>
        <p>No hay eventos para hoy.</p>
    <?php else: ?>
        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Salón</th>
                    <th>Hora Inicio</th>
                    <th>Hora Fin</th>
                    <th>Estado</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($eventos as $evento): ?>
                    <tr>
                        <td><?= esc($evento['cliente_nombre'] . ' ' . $evento['cliente_apellido']) ?></td>
                        <td><?= esc($evento['salon_nombre']) ?></td>
                        <td><?= esc($evento['hora_inicio']) ?></td>
                        <td><?= esc($evento['hora_fin']) ?></td>
                        <td><?= esc($evento['estado']) ?></td>
                        <td><?= esc($evento['total']) ?> €</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
       
        
         </div>
</div>
<?php include("templates/parte2.php");?>