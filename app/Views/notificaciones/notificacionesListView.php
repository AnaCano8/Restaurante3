<?php include("templates/parte1.php"); ?>

<div class="row">
    <div class="col-12">
        <h2>Notificaciones Recibidas</h2>

        <div class="mb-3">
            <a href="<?= base_url('notificaciones/enviadas') ?>" class="btn btn-secondary">Ver Notificaciones Enviadas</a>
            <a href="<?= base_url('notificaciones/nueva') ?>" class="btn btn-primary">Nueva Notificación</a>
        </div>

        <table class="table datatable" id="tabla">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mensaje</th>
                    <th>Remitente</th>
                    <th>Destinatario</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($notificaciones) > 0): ?>
                    <?php foreach ($notificaciones as $n): ?>
                        <tr>
                            <td><?= esc($n['id']) ?></td>
                            <td><?= esc($n['mensaje']) ?></td>
                            <td>
                                <?= esc($n['remitente_nombre'] ?? 'Desconocido') ?>
                                (ID: <?= esc($n['id_remitente']) ?>)
                                <?php if (!empty($n['remitente_email'])): ?>
                                    <br><small><?= esc($n['remitente_email']) ?></small>
                                <?php endif; ?>
                                <?php if (!empty($n['remitente_rol'])): ?>
                                    <br><small>Rol: <?= esc($n['remitente_rol']) ?></small>
                                <?php endif; ?>
                            </td>
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
                            <td>
                                <?php if ($n['estado'] === 'No leído'): ?>
                                    <form action="<?= base_url('notificaciones/leer') ?>" method="post" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="id" value="<?= esc($n['id']) ?>">
                                        <button type="submit" class="btn btn-sm btn-success">Marcar como leída</button>
                                    </form>
                                <?php endif; ?>

                                <a href="<?= base_url('notificaciones/nueva?respuesta_a=' . $n['id_remitente']) ?>" class="btn btn-sm btn-primary">Responder</a>

                                <form action="<?= base_url('notificaciones/delete') ?>" method="post" class="d-inline" onsubmit="return confirm('¿Seguro que deseas eliminar esta notificación?');">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="id" value="<?= esc($n['id']) ?>">
                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="7">No tienes notificaciones.</td></tr>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Mensaje</th>
                    <th>Remitente</th>
                    <th>Destinatario</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<?php include("templates/parte2.php"); ?>