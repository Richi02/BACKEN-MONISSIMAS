<?php
namespace App\Models;
use CodeIgniter\Model;
class CitasModel extends Model{
    protected $table ='citas';
    protected $primaryKey = 'ID_CITAS';
    protected $returnType = 'array';
    protected $allowedFields = [

    'ID_USUARIO', 'aptDate', 'aptTime', 'ID_SERVICIO', 'observacion', 'estado'

    ];
    public function getCitas(){
        return $this->db->table('citas c')
        ->where('c.estado',1)
        ->join('usuarios cc','c.ID_USUARIO = cc.ID_USUARIO')
        ->join('servicios tc','c.ID_SERVICIO = tc.ID_SERVICIO')
        ->get()->getResultArray();
    }
    public function getId($id){
        return $this->db->table('citas c')
        ->where('c.idcitas', $id)
        ->where('c.estado',1)
        ->join('usuarios cc','c.ID_USUARIO = cc.ID_USUARIO')
        ->join('servicios tc','c.ID_SERVICIO = tc.ID_SERVICIO')
        ->get()->getResultArray();
    }
    public function getUsuarios($id){
        return $this->db->table('usuarios cc')
        ->where('cc.estado',1)
        ->get()->getResultArray();
    }
    public function getServicios($id){
        return $this->db->table('servicios tc')
        ->where('tc.estado',1)
        ->get()->getResultArray();
    }
}