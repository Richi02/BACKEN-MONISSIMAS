<?php
namespace App\Models;
use CodeIgniter\Model;
class PermisosModel extends Model{
	protected $table ='permisos';
	protected $primaryKey = 'idpermisos';
	protected $returnType = 'array';
    protected $allowedFields = [

    'permisos', 'descripcionper', 'estado'

    ];
}
