<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
{
    $session = session();
    if (!$session->has('role') || $session->get('role') !== 'Administrador') {
        return redirect()->to('/')->with('error', 'Acceso denegado. Necesitas ser administrador.');
    }
}

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No se necesita lógica después
    }
}