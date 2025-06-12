<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClienteModel;
use App\Models\EventoModel;
use App\Models\EventoMenuModel;
use App\Models\PagoModel;
use App\Models\MenuModel;
use App\Models\SalonModel;
use App\Models\UsuarioModel;

class EventosController extends BaseController
{
    protected $helpers = ['form', 'url'];

    public function index()
    {
        $eventoModel     = new EventoModel();
        $clienteModel    = new ClienteModel();
        $salonModel      = new SalonModel();
        $usuarioModel    = new UsuarioModel();
        $eventoMenuModel = new EventoMenuModel();
        $menuModel       = new MenuModel();

        $eventos = $eventoModel->findAll();
        $data['eventos'] = [];

        foreach ($eventos as $e) {
            $cliente = $clienteModel->find($e['id_cliente']);
            $salon   = $salonModel->find($e['id_salon']);
            $empleado= $usuarioModel->find($e['id_empleado']);
            $relMenus= $eventoMenuModel->where('id_evento', $e['id'])->findAll();

            $detalleMenus = [];
            foreach ($relMenus as $rm) {
                $m = $menuModel->find($rm['id_menu']);
                if ($m) {
                    $detalleMenus[] = [
                        'nombre'   => $m['nombre'],
                        'cantidad' => $rm['cantidad']
                    ];
                }
            }

            $data['eventos'][] = [
                'id'               => $e['id'],
                'cliente_nombre'   => $cliente['nombre']   ?? '',
                'cliente_apellido' => $cliente['apellido'] ?? '',
                'salon_nombre'     => $salon['nombre']     ?? '',
                'fecha_evento'     => $e['fecha_evento'],
                'hora_inicio'      => $e['hora_inicio'],
                'hora_fin'         => $e['hora_fin'],
                'empleado'         => $empleado['usuario'] ?? '',
                'estado'           => $e['estado'],
                'total'            => $e['total'],
                'menus'            => $detalleMenus
            ];
        }

        return view('eventos/eventosListView', $data);
    }
public function nuevo()
{
    return $this->crear();
}
    public function crear()
    {
        $data = [
            'clientes' => (new ClienteModel())->findAll(),
            'menus'    => (new MenuModel())->findAll(),
            'salones'  => (new SalonModel())->findAll(),
        ];
        return view('eventos/eventosNewView', $data);
    }

    public function guardar()
    {
        $cModel = new ClienteModel();
        $eModel = new EventoModel();
        $emModel= new EventoMenuModel();
        $pModel = new PagoModel();

        $post = $this->request->getPost();

        // Cliente
        $clienteId = $post['cliente_existente'] 
            ?: $cModel->insert([
                'dni_nie'   => $post['dni'],
                'nombre'    => $post['nombre'],
                'apellido'  => $post['apellido'],
                'telefono'  => $post['telefono'],
                'direccion' => $post['direccion'],
                'correo'    => $post['correo'],
            ]);

        // Menús y total
        $menus = json_decode($post['menus_json'], true) ?: [];
        $total = 0;
        foreach ($menus as $m) {
            $total += $m['precio'] * $m['cantidad'];
        }

        // Evento
        $eventoId = $eModel->insert([
            'id_cliente'   => $clienteId,
            'id_empleado'  => session('id'),
            'id_salon'     => $post['id_salon'],
            'fecha_evento' => $post['fecha_evento'],
            'hora_inicio'  => $post['hora_inicio'],
            'hora_fin'     => $post['hora_fin'],
            'estado'       => $post['estado'],
            'total'        => $total,
        ]);

        // Relación evento-menus
        foreach ($menus as $m) {
            $emModel->insert([
                'id_evento' => $eventoId,
                'id_menu'   => $m['id'],
                'cantidad'  => $m['cantidad'],
            ]);
        }

        // Pago
        $pModel->insert([
            'id_evento'   => $eventoId,
            'monto'       => $total,
            'metodo_pago' => $post['metodo_pago'],
            'estado'      => 'Pagado',
        ]);

        return redirect()->to('/eventos')->with('success', 'Evento creado correctamente.');
    }

    public function editar($id)
    {
        $eModel = new EventoModel();
        $cModel = new ClienteModel();
        $sModel = new SalonModel();
        $uModel = new UsuarioModel();
        $emModel= new EventoMenuModel();
        $pModel = new PagoModel();
        $mModel = new MenuModel();

        $evento = $eModel->find($id);
        if (!$evento) return redirect()->to('/eventos')->with('error','Evento no encontrado.');

        $cliente = $cModel->find($evento['id_cliente']);
        $salones = $sModel->findAll();
        $menus   = $mModel->findAll();
        $pago    = $pModel->where('id_evento',$id)->first();

        // Cantidades asignadas
        $asign = [];
        foreach ($emModel->where('id_evento',$id)->findAll() as $rel) {
            $asign[$rel['id_menu']] = $rel['cantidad'];
        }

        $data = compact('evento','cliente','salones','menus','pago');
        $data['menusAsignados'] = $asign;
        $data['empleado']       = $uModel->find($evento['id_empleado']);

        return view('eventos/eventosEditView', $data);
    }

    public function actualizar()
    {
        $eModel = new EventoModel();
        $emModel= new EventoMenuModel();
        $pModel = new PagoModel();

        $post = $this->request->getPost();
        $idEvento = $post['id'];

        $menus = json_decode($post['menus_json'],true) ?: [];
        $total = 0; foreach($menus as $m) $total += $m['precio']*$m['cantidad'];

        $eModel->update($idEvento, [
            'id_salon'     => $post['id_salon'],
            'fecha_evento' => $post['fecha_evento'],
            'hora_inicio'  => $post['hora_inicio'],
            'hora_fin'     => $post['hora_fin'],
            'estado'       => $post['estado'],
            'total'        => $total,
        ]);

        $emModel->where('id_evento',$idEvento)->delete();
        foreach($menus as $m) {
            $emModel->insert([
                'id_evento'=>$idEvento,'id_menu'=>$m['id'],'cantidad'=>$m['cantidad']
            ]);
        }

        $pModel->where('id_evento',$idEvento)
              ->set(['monto'=>$total,'metodo_pago'=>$post['metodo_pago']])
              ->update();

        return redirect()->to('/eventos')->with('success','Evento actualizado correctamente.');
    }

    public function buscarClientePorDni()
    {
        $dni = $this->request->getPost('dni');
        $cliente = (new ClienteModel())->where('dni_nie',$dni)->first();
        if ($cliente) return $this->response->setJSON($cliente);
        return $this->response->setStatusCode(404)->setJSON(['mensaje'=>'Cliente no encontrado']);
    }
}