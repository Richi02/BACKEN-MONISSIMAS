<?php
namespace App\Models;
use CodeIgniter\Model;
class ProductosModel extends Model{
    protected $table='productos';
    protected $primaryKey='ID_PRODUCTO';
    protected $returntype='array';
    protected $allowedFields=[
        'nombreproducto', 'descripciones', 'precionormal', 'preciorebajado', 'stoks', 'imagen', 'ID_CATEGORIA', 'estado'
    ];

    // como es una tabla que tiene llaves foraneas vamos a crear 
    //las relaciones en el modelp

    public function getProductos(){
        return $this->db->table('productos c')
        ->where('c.estado',1)
        ->join('categorias cc','c.ID_CATEGORIA = cc.ID_CATEGORIA')
        ->get()->getResultArray();
    }
    public function getId($id){
        return $this->db->table('productos c')
        ->where('c.ID_PRODUCTO', $id)
        ->where('c.estado',1)
        ->join('categorias cc','c.ID_CATEGORIA = cc.ID_CATEGORIA')
        ->get()->getResultArray();
    }
    public function getCategorias($id){
        return $this->db->table('categorias cc')
        ->where('cc.estado',1)
        ->get()->getResultArray();
    }
}