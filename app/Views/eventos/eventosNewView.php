<?php include("templates/parte1.php"); ?>
<div class="container mt-4">
    <h2>Crear Nuevo Evento</h2>
    <?= validation_list_errors() ?>
    <form action="<?= base_url('eventos/guardar') ?>" method="post" id="formEvento">
        <!-- Empleado -->
        <div class="mb-3">
            <label>Empleado Responsable</label>
            <input type="text" class="form-control" readonly value="<?= esc(session('usuario')) ?>">
        </div>
        <!-- Cliente -->
        <div class="mb-3">
            <label>Tipo Cliente</label>
            <select name="tipo_cliente" id="tipo_cliente" class="form-select">
                <option value="nuevo" selected>Nuevo</option>
                <option value="existente">Existente</option>
            </select>
        </div>
        <div id="nuevoCliente">
            <input type="text" class="form-control mb-2" name="dni" placeholder="DNI/NIE">
            <input type="text" class="form-control mb-2" name="nombre" placeholder="Nombre">
            <input type="text" class="form-control mb-2" name="apellido" placeholder="Apellido">
            <input type="text" class="form-control mb-2" name="telefono" placeholder="Teléfono">
            <input type="text" class="form-control mb-2" name="direccion" placeholder="Dirección">
            <input type="email" class="form-control mb-2" name="correo" placeholder="Correo">
        </div>
        <div id="clienteExistente" style="display:none;">
            <div class="mb-3">
                <label>Buscar Cliente (DNI)</label>
                <div class="input-group">
                    <input type="text" id="buscar_dni" class="form-control">
                    <button type="button" id="buscarCliente" class="btn btn-primary">Buscar</button>
                </div>
            </div>
            <input type="hidden" name="cliente_existente" id="cliente_existente_id">
            <input type="text" class="form-control mb-2" id="cliente_nombre" disabled>
            <input type="text" class="form-control mb-2" id="cliente_apellido" disabled>
            <input type="text" class="form-control mb-2" id="cliente_telefono" disabled>
        </div>
        <!-- Evento -->
        <div class="mb-3">
            <label>Salón</label>
            <select name="id_salon" class="form-select">
                <?php foreach($salones as $s): ?>
                    <option value="<?= $s['id'] ?>"><?= esc($s['nombre']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3"><input type="date" name="fecha_evento" class="form-control"></div>
        <div class="mb-3"><input type="time" name="hora_inicio" class="form-control"></div>
        <div class="mb-3"><input type="time" name="hora_fin" class="form-control"></div>
        <div class="mb-3">
            <label>Estado</label>
            <select name="estado" class="form-select">
                <option value="Pendiente" selected>Pendiente</option>
                <option value="Confirmado">Confirmado</option>
                <option value="Cancelado">Cancelado</option>
            </select>
        </div>
        <!-- Menús -->
        <h4>Menús</h4>
        <div class="row mb-3">
            <div class="col-6">
                <select id="menu_select" class="form-select">
                    <option value="">-- Selecciona menú --</option>
                    <?php foreach($menus as $m): ?>
                        <option value="<?= $m['id'] ?>" data-nombre="<?= esc($m['nombre']) ?>" data-precio="<?= $m['precio'] ?>">
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
        <div class="mb-3">
            <label>Método Pago</label>
            <select name="metodo_pago" class="form-select">
                <option value="Efectivo">Efectivo</option>
                <option value="Tarjeta">Tarjeta</option>
                <option value="Transferencia">Transferencia</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Evento</button>
    </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", ()=>{
    const tipo = document.getElementById('tipo_cliente');
    const nuevo = document.getElementById('nuevoCliente');
    const exist = document.getElementById('clienteExistente');
    tipo.addEventListener('change', ()=>{
        nuevo.style.display = tipo.value==='nuevo'?'block':'none';
        exist.style.display = tipo.value==='existente'?'block':'none';
    });

    // Búsqueda cliente
    document.getElementById('buscarCliente').onclick=()=>{
        fetch('<?= base_url("eventos/buscarClientePorDni")?>',{
            method:'POST',headers:{'Content-Type':'application/x-www-form-urlencoded'},
            body:'dni='+encodeURIComponent(document.getElementById('buscar_dni').value)
        }).then(r=>r.json()).then(d=>{
            if(d.id){
                document.getElementById('cliente_existente_id').value=d.id;
                document.getElementById('cliente_nombre').value=d.nombre;
                document.getElementById('cliente_apellido').value=d.apellido;
                document.getElementById('cliente_telefono').value=d.telefono;
            } else alert('Cliente no encontrado');
        });
    };

    // Menús dinámicos
    let menus=[];
    const tabla=document.querySelector('#tabla_menus tbody');
    const sel=document.getElementById('menu_select');
    const cnt=document.getElementById('menu_cantidad');
    const inpJson=document.getElementById('menus_json');
    const inpTot=document.getElementById('total');

    document.getElementById('agregar_menu').onclick=()=>{
        const id=sel.value, cant=parseInt(cnt.value);
        if(!id||cant<1) return;
        const nombre=sel.selectedOptions[0].dataset.nombre;
        const precio=parseFloat(sel.selectedOptions[0].dataset.precio);
        const ex=menus.find(m=>m.id==id);
        if(ex) ex.cantidad+=cant;
        else menus.push({id:parseInt(id),nombre,precio,cantidad:cant});
        render();
        sel.selectedIndex=0; cnt.value=1;
    };
    window.eliminarMenu=i=>{menus.splice(i,1);render();};

    function render(){
        tabla.innerHTML=''; let tot=0;
        menus.forEach((m,i)=>{
            const sub=m.precio*m.cantidad; tot+=sub;
            tabla.innerHTML+=`<tr>
                <td>${m.nombre}</td>
                <td>${m.precio.toFixed(2)}</td>
                <td>${m.cantidad}</td>
                <td>${sub.toFixed(2)}</td>
                <td><button type="button" class="btn btn-danger btn-sm" onclick="eliminarMenu(${i})">X</button></td>
            </tr>`;
        });
        inpJson.value=JSON.stringify(menus);
        inpTot.value=tot.toFixed(2);
    }
});
</script>
<?php include("templates/parte2.php"); ?>