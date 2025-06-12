<?php

namespace App\Controllers;

use App\Models\EventoModel;

class DashboardController extends BaseController
{
   public function index()
{
    $eventoModel = new EventoModel();
    $eventosHoy = $eventoModel->getEventosHoy();

    $data = [
        'eventosHoy' => $eventosHoy,
    ];

    return view('dashboards/dashboardListView', $data);
}
}