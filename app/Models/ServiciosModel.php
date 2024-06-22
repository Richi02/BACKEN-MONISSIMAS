<?php
namespace App\Models;
use CodeIgniter\Model;
class ServiciosModel extends Model{
    protected $table='servicios';
    protected $primaryKey='ID_SERVICIO';
    protected $returntype='array';
    protected $allowedFields=[
         'nombreservicio', 'precioservicio', 'descripciones', 'imagen', 'estado'
    ];
}

