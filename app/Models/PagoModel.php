<?php
namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class PagoModel extends Model
{
    protected $table='pagos';
    protected $allowedFields=['id_evento','monto', 'metodo_pago','estado','fecha_pago','created_at', 'updated_at'];
    
}
?>