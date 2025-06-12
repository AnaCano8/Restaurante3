<?php
namespace App\Controllers;

use App\Models\NotificacionesModel;
use App\Models\UsuarioModel;

class NotificacionesController extends BaseController
{
    protected $helpers = ['form'];

    public function index()
{
    $model = new NotificacionesModel();
    $id_usuario = session('id');

    $data['notificaciones'] = $model
        ->select('notificaciones.*, u_remitente.usuario as remitente_nombre, u_remitente.email as remitente_email, r_remitente.role as remitente_rol, u_destinatario.usuario as destinatario_nombre, u_destinatario.email as destinatario_email, r_destinatario.role as destinatario_rol')
        ->join('usuarios u_remitente', 'u_remitente.id = notificaciones.id_remitente')
        ->join('roles r_remitente', 'r_remitente.id = u_remitente.id_roles')
        ->join('usuarios u_destinatario', 'u_destinatario.id = notificaciones.id_usuario')
        ->join('roles r_destinatario', 'r_destinatario.id = u_destinatario.id_roles')
        ->where('notificaciones.id_usuario', $id_usuario)
        ->orderBy('notificaciones.created_at', 'DESC')
        ->findAll();

    return view('notificaciones/notificacionesListView', $data);
		
	}

   public function enviadas()
{
    $model = new NotificacionesModel();
    $id_remitente = session('id');

    $data['notificaciones'] = $model
        ->select('notificaciones.*, usuarios.usuario as destinatario_nombre, usuarios.email as destinatario_email, roles.role as destinatario_rol')
        ->join('usuarios', 'usuarios.id = notificaciones.id_usuario')
        ->join('roles', 'roles.id = usuarios.id_roles')
        ->where('id_remitente', $id_remitente)
        ->orderBy('created_at', 'DESC')
        ->findAll();

    return view('notificaciones/notificacionesSentView', $data);
}

    public function nueva()
    {
        $usuariosModel = new UsuarioModel();
        $data['usuarios'] = $usuariosModel->findAll();

        $idRespuesta = $this->request->getGet('respuesta_a');
        $data['id_preseleccionado'] = $idRespuesta ?? null;

        return view('notificaciones/notificacionesNewView', $data);
    }

    public function crear()
    {
        $rules = [
            'id_usuario' => ['rules' => 'required', 'errors' => ['required' => 'Debes seleccionar un destinatario']],
            'mensaje' => ['rules' => 'required', 'errors' => ['required' => 'Debes escribir un mensaje']],
        ];

        $datos = $this->request->getPost(array_keys($rules));

        if (!$this->validateData($datos, $rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new NotificacionesModel();
        $model->save([
            'id_usuario' => $this->request->getPost('id_usuario'),
            'id_remitente' => session('id'),
            'mensaje' => $this->request->getPost('mensaje'),
            'estado' => 'No leído',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        $this->registrarAuditoria('Envió de notificación a usuario ID: ' . $this->request->getPost('id_usuario'));

        return redirect()->to('/notificaciones');
    }

    public function leer()
    {
        $id = $this->request->getPost('id');
        $model = new NotificacionesModel();
        $model->update($id, ['estado' => 'Leído', 'updated_at' => date("Y-m-d H:i:s")]);
        $this->registrarAuditoria('Notificación leída ID: ' . $id);
        return redirect()->to('/notificaciones');
    }

    public function delete()
    {
        $model = new NotificacionesModel();
        $id = $this->request->getPost('id');

        if ($model->where('id', $id)->delete()) {
            $this->registrarAuditoria('Eliminación de notificación ID: ' . $id);
            echo 1;
        } else {
            echo 0;
        }
    }
}