<?php
namespace App\Models;
use CodeIgniter\Model;
class RolesModel extends Model{
    protected $table='rol';
    protected $primaryKey='idrol';
    protected $returntype='array';
    protected $allowedFields=[
         'nombre', 'descripcionrol', 'estado'
    ];
}