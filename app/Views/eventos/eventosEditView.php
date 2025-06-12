<?php include("templates/parte1.php"); ?>

<div class="container mt-4">
    <h2>Editar Evento #<?= $evento['id'] ?></h2>
    <?= validation_list_errors() ?>

    <form action="<?= base_url('eventos/actualizar') ?>" method="post" id="formEvento">
        <input type="hidden" name="id" value="<?= $evento['id'] ?>">

        <!-- Empleado Responsable -->
        <div class="mb-3">
            <label>Empleado Responsable</label>
            <input type="text" class="form-control" readonly value="<?= esc($empleado['usuario']) ?>">
        </div>

        <!-- Cliente -->
        <div class="mb-3">
            <label>Cliente</label>
            <input type="text" class="form-control" readonly
                value="<?= esc($cliente['nombre'] . ' ' . $cliente['apellido']) ?>">
        </div>

        <!-- Datos del Evento -->
        <h4>Datos del Evento</h4>
        <div class="mb-3">
            <label>Salón</label>
            <select name="id_salon" class="form-select">
                <?php foreach ($salones as $s): ?>
                    <option value="<?= $s['id'] ?>" <?= $evento['id_salon'] == $s['id'] ? 'selected' : '' ?>>
                        <?= esc($s['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3"><input type="date" name="fecha_evento" class="form-control"
            value="<?= $evento['fecha_evento'] ?>"></div>
        <div class="mb-3"><input type="time" name="hora_inicio" class="form-control"
            value="<?= $evento['hora_inicio'] ?>"></div>
        <div class="mb-3"><input type="time" name="hora_fin" class="form-control"
            value="<?= $evento['hora_fin'] ?>"></div>
        <div class="mb-3">
            <label>Estado</label>
            <select name="estado" class="form-select">
                <option value="Pendiente" <?= $evento['estado'] == 'Pendiente' ? 'selected' : '' ?>>Pendiente</option>
                <option value="Confirmado" <?= $evento['estado'] == 'Confirmado' ? 'selected' : '' ?>>Confirmado</option>
                <option value="Cancelado" <?= $evento['estado'] == 'Cancelado' ? 'selected' : '' ?>>Cancelado</option>
            </select>
        </div>

        <!-- Menús -->
        <h4>Menús</h4>
        <div class="row mb-3">
            <div class="col-6">
                <select id="menu_select" class="form-select">
                    <option value="">-- Selecciona menú --</option>
                    <?php foreach ($menus as $m): ?>
                        <option value="<?= $m['id'] ?>"
                            data-nombre="<?= esc($m['nombre']) ?>"
                            data-precio="<?= $m['precio'] ?>">
                            <?= esc($m['nombre']) ?> - €<?= $m['precio'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-3">
                <input type="number" id="menu_cantidad" class="form-control" min="1" value="1">
            </div>
            <div class="col-3">
                <button type="button" id="agregar_menu" class="btn btn-success w-100">Agregar</button>
            </div>
        </div>

        <table class="table" id="tabla_menus">
            <thead><tr><th>Menú</th><th>Precio</th><th>Cant.</th><th>Subtotal</th><th></th></tr></thead>
            <tbody></tbody>
        </table>

        <input type="hidden" name="menus_json" id="menus_json">
        <div class="mb-3">
            <label>Total (€)</label>
            <input type="text" id="total" name="total" class="form-control" readonly>
        </div>

        <!-- Pago -->
        <h4>Pago</h4>
        <div class="mb-3">
            <label>Método de Pago</label>
            <select name="metodo_pago" class="form-select">
                <option value="Efectivo" <?= $pago['metodo_pago']=='Efectivo'?'selected':'' ?>>Efectivo</option>
                <option value="Tarjeta" <?= $pago['metodo_pago']=='Tarjeta'?'selected':'' ?>>Tarjeta</option>
                <option value="Transferencia" <?= $pago['metodo_pago']=='Transferencia'?'selected':'' ?>>Transferencia</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Evento</button>
    </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", ()=> {
    const tabla = document.querySelector("#tabla_menus tbody");
    const jsonInput = document.getElementById("menus_json");
    const totalInput = document.getElementById("total");
    const select = document.getElementById("menu_select");
    const cnt    = document.getElementById("menu_cantidad");
    const btn    = document.getElementById("agregar_menu");

    // Todos los menús (id, nombre, precio)
    const allMenus = <?= json_encode($menus, JSON_UNESCAPED_SLASHES) ?>;

    // Menús asignados originalmente
    const assignedIds    = <?= json_encode(array_keys($menusAsignados), JSON_UNESCAPED_SLASHES) ?>;
    const assignedCounts = <?= json_encode(array_values($menusAsignados), JSON_UNESCAPED_SLASHES) ?>;

    // Construimos array inicial sin usar índices PHP
    let menusArray = [];
    for (let i = 0; i < assignedIds.length; i++) {
        const id = assignedIds[i], qty = assignedCounts[i];
        const found = allMenus.find(m => m.id == id);
        if (found) {
            menusArray.push({
                id: id,
                nombre: found.nombre,
                precio: parseFloat(found.precio),
                cantidad: qty
            });
        }
    }

    function render() {
        tabla.innerHTML = "";
        let total = 0;
        menusArray.forEach((m, idx) => {
            const subtotal = m.precio * m.cantidad;
            total += subtotal;
            tabla.innerHTML += `
                <tr>
                    <td>${m.nombre}</td>
                    <td>${m.precio.toFixed(2)}</td>
                    <td>${m.cantidad}</td>
                    <td>${subtotal.toFixed(2)}</td>
                    <td><button type="button" class="btn btn-danger btn-sm" onclick="removeMenu(${idx})">X</button></td>
                </tr>`;
        });
        jsonInput.value = JSON.stringify(menusArray);
        totalInput.value = total.toFixed(2);
    }

    window.removeMenu = idx => {
        menusArray.splice(idx, 1);
        render();
    };

    btn.addEventListener("click", () => {
        const id = select.value;
        const qty= parseInt(cnt.value);
        if (!id || isNaN(qty) || qty<1) return;
        const menuInfo = allMenus.find(m=>m.id==id);
        if (!menuInfo) return;
        const exists = menusArray.find(m=>m.id==id);
        if (exists) exists.cantidad += qty;
        else menusArray.push({
            id: id,
            nombre: menuInfo.nombre,
            precio: parseFloat(menuInfo.precio),
            cantidad: qty
        });
        select.selectedIndex = 0;
        cnt.value = 1;
        render();
    });

    render();
});
</script>

<?php include("templates/parte2.php"); ?>