<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index',['filter'=>'authGuard']);
$routes->get('/inicio', 'Home::index',['filter'=>'authGuard']);
$routes->match(['get','post'],'/inicioGet', 'Home::inicioGet');
$routes->get('/formulario', 'Home::formulario',['filter'=>'authGuard']);

$routes->match( ['get','post'],'/verificar', 'Home::comprobar');



$routes->match( ['get','post'],'/SiginController/loginAuth', 'SiginController::loginAuth');
$routes->get('/salir', 'ProfileController::cerrar_sesion');
$routes->get('logout', 'SiginController::logout');
$routes->get('/sigin', 'SiginController::index',['filter'=>'noauthGuard']);

//Salones
$routes->get('/salones', 'SalonesController::index');
$routes->group('salones', ['filter' => 'admin'], function($routes) {
    $routes->get('nuevo', 'SalonesController::nuevo');
    $routes->match(['get','post'], 'crear', 'SalonesController::crear');
    $routes->match(['get','post'], 'editar', 'SalonesController::editar');
    $routes->match(['get','post'], 'actualizar', 'SalonesController::actualizar');
    $routes->match(['get','post'], 'eliminar', 'SalonesController::delete');
});

//MENUS
$routes->get('/menus', 'MenusController::index');
$routes->group('menus', ['filter' => 'admin'], function($routes) {
    $routes->get('nuevo', 'MenusController::nuevo');
    $routes->match(['get','post'], 'crear', 'MenusController::crear');
    $routes->match(['get','post'], 'editar', 'MenusController::editar');
    $routes->match(['get','post'], 'actualizar', 'MenusController::actualizar');
    $routes->match(['get','post'], 'eliminar', 'MenusController::delete');
});



//ROLES
$routes->group('roles', ['filter' => 'admin'], function($routes) {
    $routes->get('/', 'RolesController::index');
    $routes->get('nuevo', 'RolesController::nuevo');
    $routes->match(['get','post'], 'crear', 'RolesController::crear');
    $routes->match(['get','post'], 'editar', 'RolesController::editar');
    $routes->match(['get','post'], 'actualizar', 'RolesController::actualizar');
    $routes->match(['get','post'], 'eliminar', 'RolesController::delete');
});

//AUDITORIAS
$routes->group('auditorias', ['filter' => 'admin'], function($routes) {
$routes->get('/', 'AuditoriasController::index');
	});

//USUARIOS
$routes->group('usuarios', ['filter' => 'admin'], function($routes) {
    $routes->get('/', 'UsuariosController::index');
    $routes->get('nuevo', 'UsuariosController::nuevo');
    $routes->match(['get','post'], 'crear', 'UsuariosController::crear');
    $routes->match(['get','post'], 'editar', 'UsuariosController::editar');
    $routes->match(['get','post'], 'actualizar', 'UsuariosController::actualizar');
    $routes->match(['get','post'], 'eliminar', 'UsuariosController::delete');
    $routes->match(['get','post'], 'exportar', 'UsuariosController::exportar');
});

//NOTIFICACIONES

   $routes->get('notificaciones', 'NotificacionesController::index');              // Listar notificaciones recibidas
$routes->get('notificaciones/enviadas', 'NotificacionesController::enviadas'); // Listar notificaciones enviadas
$routes->get('notificaciones/nueva', 'NotificacionesController::nueva');       // Formulario para crear notificación
$routes->post('notificaciones/crear', 'NotificacionesController::crear');      // Crear notificación (POST)
$routes->post('notificaciones/leer', 'NotificacionesController::leer');        // Marcar notificación como leída (POST)
$routes->post('notificaciones/delete', 'NotificacionesController::delete'); 


//DASHBOARD
$routes->get('dashboard', 'DashboardController::index');

//EVENTOS
$routes->get('eventos', 'EventosController::index');
$routes->get('eventos/nuevo', 'EventosController::nuevo');
$routes->get('eventos/crear', 'EventosController::crear');
$routes->post('eventos/guardar', 'EventosController::guardar');
$routes->get('eventos/editar/(:num)', 'EventosController::editar/$1');
$routes->post('eventos/actualizar', 'EventosController::actualizar');
$routes->get('eventos/eliminar/(:num)', 'EventosController::eliminar/$1');
$routes->post('eventos/buscarClientePorDni', 'EventosController::buscarClientePorDni');