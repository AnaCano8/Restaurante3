<?php

namespace App\Models;
use CodeIgniter\Model;

class AuditoriaModel extends Model
{
	 protected $table = 'auditoria'; // ✅ CORREGIDO
    protected $primaryKey = 'id';

    protected $allowedFields = ['id_usuario', 'accion', 'ip', 'fecha', 'created_at', 'updated_at'];

    protected $useTimestamps = false;
    
	
	public function obtenerAuditoriasConUsuario()
{
    return $this->select('auditoria.*, usuarios.usuario AS nombre_usuario')
                ->join('usuarios', 'usuarios.id = auditoria.id_usuario')
                ->orderBy('auditoria.fecha', 'DESC')
                ->findAll();
}
}
