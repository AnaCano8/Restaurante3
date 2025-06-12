<?php
namespace App\Models;

use CodeIgniter\Model;

class EventoModel extends Model
{
    protected $table = 'eventos';  // <--- Aquí pon el nombre exacto de tu tabla en la DB

    protected $allowedFields = [
        'id_cliente',
        'id_empleado',
        'id_salon',
        'fecha_evento',
        'hora_inicio',
        'hora_fin',
        'estado',
        'total',
        'created_at',
        'updated_at',
    ];

    public function getEventosHoy()
    {
        return $this->select('eventos.*, clientes.nombre as cliente_nombre, clientes.apellido as cliente_apellido, salones.nombre as salon_nombre')
                    ->join('clientes', 'clientes.id = eventos.id_cliente')
                    ->join('salones', 'salones.id = eventos.id_salon')
                    ->where('fecha_evento', date('Y-m-d'))
                    ->findAll();
    }
}
?>