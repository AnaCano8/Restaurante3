<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UsuarioModel;


class SiginController extends BaseController
{
    
    protected $helpers=['form'];
    
    public function index()
    {
         return view('loginView'); 
    }
    public function loginAuth()
{
    $rules = [
        'username' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Debes introducir un nombre de usuario'
            ]
        ],
        'password' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Debes introducir una contraseña'
            ]
        ],
    ];

    $datos = $this->request->getPost(array_keys($rules));

    if (! $this->validateData($datos, $rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $username = $this->request->getVar('username');
    $password = $this->request->getVar('password');

    $userModel = new UsuarioModel();
    $data = $userModel->join('roles', 'usuarios.id_roles=roles.id')
        ->select('usuarios.id, usuarios.usuario, usuarios.password, usuarios.email, usuarios.id_roles, roles.role')
        ->where('usuario', $username)
        ->first();

    if ($data) {
        $pass = $data['password'];

        // Aquí se recomienda usar password_verify, pero si usas md5, mantén la lógica actual
        // Cambia esta parte si migras a password_hash
        $authenticatePassword = false;
        if (password_verify($password, $pass)) {
            $authenticatePassword = true;
        } elseif (md5($password) === $pass) {
            $authenticatePassword = true;
        }

        if ($authenticatePassword) {
            $sessionData = [
                'id'       => $data['id'],
                'usuario'  => $data['usuario'],
                'email'    => $data['email'],
                'id_roles' => $data['id_roles'],
                'role'     => $data['role'],
                'isLoggedIn' => true,
            ];

            $session = session();
            $session->set($sessionData);

            // Registrar auditoría
            $this->registrarAuditoria('Inicio de sesión');

            // Redireccionar según rol
            return redirect()->to('/');
            }
        }
    }
	public function logout()
{
    $session = session();
    $session->destroy(); // Elimina todos los datos de sesión

    return redirect()->to('/'); // Redirige a la vista de login
}

    
}
	
    

