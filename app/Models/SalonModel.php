<?php
namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class SalonModel extends Model
{
    protected $table='salones';
    protected $allowedFields=['nombre', 'capacidad','created_at', 'updated_at'];
    
}
?>