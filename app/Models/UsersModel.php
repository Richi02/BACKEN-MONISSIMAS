<?php
namespace App\Models;
use CodeIgniter\Model;
class UsersModel extends Model{
	protected $table='user';
	protected $primaryKey='idusuario';
	protected $returntype='array';
	protected $allowedFields=[
		'usuario', 'password', 'rolid', 'empresaid', 'sucursalid', 'estado'
	];

	// como es una tabla que tiene llaves foraneas vamos a crear 
	//las relaciones en el modelo

	public function getUsers(){
		return $this->db->table('user c')
		->where('c.estado',1)
		->join('rol tc','c.rolid = tc.idrol')
		->join('empresa cc','c.empresaid = cc.idempresa')
		->join('sucursal nc','c.sucursalid = nc.sucuid')
		->get()->getResultArray();
	}
	public function getLogin($usu){
        $user = explode('&', $usu);
        if(count($user) == 2){
            $usuarios = $user[0];
            $password = $user[1];
            //$sucursal = $user[2];
            return $this -> db -> table('user u')
            ->where('u.usuarios', $usuarios)
            ->where('u.password', $password)
            //->where('u.sucu_id', $sucursal)
            ->where('u.estado', 1)
            ->join('rol tc','c.rolid = tc.idrol')
			->join('empresa cc','c.empresaid = cc.idempresa')
			->join('sucursal nc','c.sucursalid = nc.sucuid')
            ->get()->getResultArray();
        }else{
            return 'El usuario no es valido';
        }
    }
	public function getRol($id){
		return $this->db->table('rol tc')
		->where('tc.estado',1)
		->get()->getResultArray();
	}
	public function getEmpresa($id){
		return $this->db->table('empresa cc')
		->where('cc.estado',1)
		->get()->getResultArray();
	}
	public function getSucursal($id){
		return $this->db->table('sucursal nc')
		->where('nc.estado',1)
		->get()->getResultArray();
	}
}