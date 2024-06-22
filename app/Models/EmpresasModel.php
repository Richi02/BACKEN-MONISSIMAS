<?php
namespace App\Models;
use CodeIgniter\Model;
class EmpresasModel extends Model{
	protected $table ='empresa';
	protected $primaryKey = 'idempresa';
	protected $returnType = 'array';
    protected $allowedFields = [

    'empresanombre', 'empresaTelefono', 'empresaCorreo', 'provincia', 'distrito', 'departamento', 'estado'

    ];
}
