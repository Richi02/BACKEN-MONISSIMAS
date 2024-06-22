<?php
namespace App\Models;
use CodeIgniter\Model;
class VentasModel extends Model{
    protected $table='ventas';
    protected $primaryKey='ID_VENTAS';
    protected $returntype='array';
    protected $allowedFields=[
        'ID_PRODUCTO', 'ID_USUARIO', 'precios', 'cantidades', 'fecha', 'subtotal', 'totalventa', 'ID_TIPOPAGO', 'estado'
    ];

    // como es una tabla que tiene llaves foraneas vamos a crear 
    //las relaciones en el model

    public function getVentas(){
        return $this->db->table('ventas c')
        ->where('c.estado',1)
        ->join('productos cc','c.ID_PRODUCTO = cc.ID_PRODUCTO')
        ->join('usuarios tc','c.ID_USUARIO = tc.ID_USUARIO')
        ->join('tipopago uc','c.ID_TIPOPAGO = uc.ID_TIPOPAGO')
        ->get()->getResultArray();
    }
    public function getId($id){
        return $this->db->table('ventas c')
        ->where('c.idventas', $id)
        ->where('c.estado',1)
        ->join('productos cc','c.ID_PRODUCTO = cc.ID_PRODUCTO')
        ->join('usuarios tc','c.ID_USUARIO = tc.ID_USUARIO')
        ->join('tipopago uc','c.ID_TIPOPAGO = uc.ID_TIPOPAGO')
        ->get()->getResultArray();
    }
    public function getProductos($id){
        return $this->db->table('productos cc')
        ->where('cc.estado',1)
        ->get()->getResultArray();
    }
    public function getUsuarios($id){
        return $this->db->table('usuarios tc')
        ->where('tc.estado',1)
        ->get()->getResultArray();
    }
    public function getTipoPagos($id){
        return $this->db->table('tipopago uc')
        ->where('uc.estado',1)
        ->get()->getResultArray();
    }
}