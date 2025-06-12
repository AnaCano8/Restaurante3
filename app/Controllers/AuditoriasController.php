<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\AuditoriaModel;


class AuditoriasController extends BaseController
{
   protected $helpers = ['form'];

    public function index()
    {
        $session = session();

        // Seguridad: solo Admin puede ver esto
        if ($session->get('role') !== 'Administrador') {
            return redirect()->to('/');
        }

        // Instanciar el modelo
        $auditoriaModel = new AuditoriaModel();

        // ✅ AQUÍ es donde va esta línea
        $auditorias = $auditoriaModel->obtenerAuditoriasConUsuario();

        // Preparar datos para la vista
        $data = [
            'auditorias' => $auditorias
        ];

        return view('auditorias/auditoriasListView', $data);
    }
}
