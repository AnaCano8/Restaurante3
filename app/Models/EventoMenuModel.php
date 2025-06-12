<?php

namespace App\Models;

use CodeIgniter\Model;

class EventoMenuModel extends Model
{
    protected $table            = 'eventos_menus';
    protected $primaryKey       = 'id';

    protected $allowedFields    = [
        'id_evento',
        'id_menu',
        'cantidad',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Opcional: Validaciones (puedes ajustar según necesidades)
    protected $validationRules = [
        'id_evento' => 'required|integer',
        'id_menu'   => 'required|integer',
        'cantidad'  => 'required|integer|greater_than[0]'
    ];
}
?>