<?php
namespace App\Models;
use CodeIgniter\Model;
class SucursalesModel extends Model{
    protected $table='sucursal';
    protected $primaryKey='sucuid';
    protected $returntype='array';
    protected $allowedFields=[
        'sucunombre', 'sucudireccion', 'sucutelefono', 'horario', 'idservicios', 'empleados', 'idempresa', 'estado'
    ];

    // como es una tabla que tiene llaves foraneas vamos a crear 
    //las relaciones en el modelp

    public function getSucursales(){
        return $this->db->table('sucursal c')
        ->where('c.estado',1)
        ->join('servicios cc','c.idservicios = cc.idservicio')
        ->join('empresa tc','c.idempresa = tc.idempresa')
        ->get()->getResultArray();
    }
    public function getId($id){
        return $this->db->table('sucursal c')
        ->where('c.sucuid', $id)
        ->where('c.estado',1)
        ->join('servicios cc','c.idservicios = cc.idservicio')
        ->join('empresa tc','c.idempresa = tc.idempresa')
        ->get()->getResultArray();
    }
    public function getServicios($id){
        return $this->db->table('servicios cc')
        ->where('cc.estado',1)
        ->get()->getResultArray();
    }
    public function getEmpresa($id){
        return $this->db->table('empresa tc')
        ->where('tc.estado',1)
        ->get()->getResultArray();
    }
}