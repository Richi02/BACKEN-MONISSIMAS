<?php
namespace App\Models;
use CodeIgniter\Model;
class TipospagosModel extends Model{
    protected $table='tipopago';
    protected $primaryKey='ID_TIPOPAGO';
    protected $returnType='array';
    protected $allowedFields=[ 
       'tipo', 'estado'
    ];
}