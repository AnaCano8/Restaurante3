<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AuditoriaModel;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }
	protected function registrarAuditoria(string $accion)
    {
        $session = session();
        $auditoriaModel = new AuditoriaModel();

        $auditoriaModel->insert([
            'id_usuario' => $session->get('id'),
            'accion'     => $accion,
            'ip'         => $this->request->getIPAddress()
        ]);
    }
	public function auditorias()
{
    $session = session();

    // Validar rol para seguridad
    if ($session->get('role') !== 'Administrador') {
        // Redirigir si no es admin
        return redirect()->to('/');
    }

    $auditoriaModel = new \App\Models\AuditoriaModel();

    // Obtener todas las auditorías (puedes agregar paginación o filtros aquí)
    $auditorias = $auditoriaModel->findAll();

    // Pasar datos a la vista
    return view('auditorias/auditoriasListView',$data);
}
}
