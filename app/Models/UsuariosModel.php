<?php
namespace App\Models;
use CodeIgniter\Model;
class UsuariosModel extends Model{
    protected $table='usuarios';
    protected $primaryKey='ID_USUARIO';
    protected $returntype='array';
    protected $allowedFields=[
        'nombres', 'correo', 'telefono', 'dni', 'usuario', 'password', 'estado'
    ];

    // como es una tabla que tiene llaves foraneas vamos a crear 
    //las relaciones en el modelp

    public function getUsuarios(){
		return $this->db->table('usuarios c')
		->where('c.estado',1)
		->get()->getResultArray();
	}
    public function getLogin($usu){
        $usuario = explode('&', $usu);
        if(count($usuario) == 2){
            $usuarios = $usuario[0];
            $password = $usuario[1];
            //$sucursal = $usuario[2];
            return $this -> db -> table('usuarios c')
            ->where('c.usuario', $usuarios)
            ->where('c.password', $password)
            ->where('c.estado', 1)
            ->get()->getResultArray();
        }else{
            return 'El usuario no es valido';
        }
    }

}