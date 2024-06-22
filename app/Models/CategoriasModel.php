<?php
namespace App\Models;
use CodeIgniter\Model;
class CategoriasModel extends Model{
    protected $table='categorias';
    protected $primaryKey='ID_CATEGORIA';
    protected $returnType='array';
    protected $allowedFields=[ 
       'nombrecategoria', 'imgcat', 'estado'
    ];
}