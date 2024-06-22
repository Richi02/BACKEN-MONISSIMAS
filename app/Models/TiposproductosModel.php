<?php
namespace App\Models;
use CodeIgniter\Model;
class TiposproductosModel extends Model{
    protected $table='tipoproducto';
    protected $primaryKey='idtipoproducto';
    protected $returnType='array';
    protected $allowedFields=[ 
       'marca', 'estado'
    ];
}