<?php
namespace App\Models;

use CodeIgniter\Model;

class NotificacionesModel extends Model
{
    protected $table = 'notificaciones';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_usuario', 'id_remitente', 'mensaje', 'estado', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
?>