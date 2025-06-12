<?php include("templates/parte1.php"); ?>

<div class="row">
    <div class="col-12">
        <h2>Notificaciones Enviadas</h2>

        <div class="mb-3">
            <a href="<?= base_url('notificaciones') ?>" class="btn btn-secondary">Ver Notificaciones Recibidas</a>
            <a href="<?= base_url('notificaciones/nueva') ?>" class="btn btn-primary">Nueva Notificación</a>
        </div>

        <table class="table datatable" id="tabla">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mensaje</th>
                    <th>Destinatario</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($notificaciones) > 0): ?>
                    <?php foreach ($notificaciones as $n): ?>
                        <tr>
                            <td><?= esc($n['id']) ?></td>
                            <td><?= esc($n['mensaje']) ?></td>
                            <td>
                                <?= esc($n['destinatario_nombre'] ?? 'Desconocido') ?>
                                (ID: <?= esc($n['id_usuario']) ?>)
                                <?php if (!empty($n['destinatario_email'])): ?>
                                    <br><small><?= esc($n['destinatario_email']) ?></small>
                                <?php endif; ?>
                                <?php if (!empty($n['destinatario_rol'])): ?>
                                    <br><small>Rol: <?= esc($n['destinatario_rol']) ?></small>
                                <?php endif; ?>
                            </td>
                            <td><?= esc($n['estado']) ?></td>
                            <td><?= esc($n['created_at']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5">No has enviado notificaciones.</td></tr>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Mensaje</th>
                    <th>Destinatario</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<?php include("templates/parte2.php"); ?>