<?php
namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class ClienteModel extends Model
{
    protected $table='clientes';
    protected $allowedFields=['dni_nie','nombre', 'apellido','telefono','direccion','correo','created_at', 'updated_at'];
    
}
?>