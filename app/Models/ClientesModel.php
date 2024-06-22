<?php
namespace App\Models;
use CodeIgniter\Model;
class ClientesModel extends Model{
    protected $table='clientes';
    protected $primaryKey='id';
    protected $returnType='array';
    protected $allowedFields=[ 
       'nameClient', 'direccionCli', 'correoClient', 'numberClient', 'genero', 
       'fechaNacimiento', 'tipodocu', 'numerodocu', 'estado'
    ];
}