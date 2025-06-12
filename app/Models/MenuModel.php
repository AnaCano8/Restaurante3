<?php
namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table='menus';
    protected $allowedFields=['nombre','tipo_evento', 'descripcion','precio','created_at', 'updated_at'];
    
}
?>