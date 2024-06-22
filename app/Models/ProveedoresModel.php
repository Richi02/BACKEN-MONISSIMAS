<?php
namespace App\Models;
use CodeIgniter\Model;
class ProveedoresModel extends Model{
    protected $table='proveedores';
    protected $primaryKey='provid ';
    protected $returnType='array';
    protected $allowedFields=[ 
       'pronombre', 'tipoDocumento', 'numeroDocumento', 'direccion', 
       'telefono', 'correo', 'estado'
    ];
}