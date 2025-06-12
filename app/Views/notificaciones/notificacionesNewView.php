<?php include("templates/parte1.php"); ?>

<div class="row">
    <div class="col-12">
        <h2>Enviar Notificación</h2>

        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('notificaciones/crear') ?>" method="post">
            <?= csrf_field() ?>

            <?php if (isset($id_preseleccionado) && $id_preseleccionado): ?>
                <?php
                    $usuarioNombre = 'Usuario';
                    foreach ($usuarios as $u) {
                        if ($u['id'] == $id_preseleccionado) {
                            $usuarioNombre = $u['usuario'];
                            break;
                        }
                    }
                ?>
                <div class="mb-3">
                    <label class="form-label">Destinatario:</label>
                    <input type="hidden" name="id_usuario" value="<?= esc($id_preseleccionado) ?>">
                    <input type="text" class="form-control" value="<?= esc($usuarioNombre) ?>" disabled>
                </div>
            <?php else: ?>
                <div class="mb-3">
                    <label for="id_usuario" class="form-label">Destinatario:</label>
                    <select name="id_usuario" id="id_usuario" class="form-select" required>
                        <option value="">-- Seleccionar usuario --</option>
                        <?php foreach ($usuarios as $usuario): ?>
                            <option value="<?= $usuario['id'] ?>" <?= set_select('id_usuario', $usuario['id']) ?>>
                                <?= esc($usuario['usuario']) ?> (<?= esc($usuario['email'] ?? '') ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endif; ?>

            <div class="mb-3">
                <label for="mensaje" class="form-label">Mensaje:</label>
                <textarea name="mensaje" id="mensaje" rows="5" class="form-control" required><?= set_value('mensaje') ?></textarea>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <a href="<?= base_url('notificaciones') ?>" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<?php include("templates/parte2.php"); ?>
