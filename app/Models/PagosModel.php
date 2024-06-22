<?php
namespace App\Models;
use CodeIgniter\Model;
class PagosModel extends Model{
    protected $table='pagos';
    protected $primaryKey='idpago';
    protected $returntype='array';
    protected $allowedFields=[
        'id_tipopago', 'estado'
    ];

    // como es una tabla que tiene llaves foraneas vamos a crear 
    //las relaciones en el modelo

    public function getPagos(){
        return $this->db->table('pagos c')
        ->where('c.estado',1)
        ->join('tipopago tc','c.id_tipopago = tc.idtipopago')
        ->get()->getResultArray();
    }
    public function getId($id){
        return $this->db->table('pagos c')
        ->where('c.idpago', $id)
        ->where('c.estado',1)
        ->join('tipopago tc','c.id_tipopago = tc.idtipopago')
        ->get()->getResultArray();
    }
    public function getTipoPago($id){
        return $this->db->table('tipopago tc')
        ->where('tc.estado',1)
        ->get()->getResultArray();
    }
}