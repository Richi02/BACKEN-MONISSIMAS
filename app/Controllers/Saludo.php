<?php

namespace App\Controllers;
use CodeIgniter\Controller;
class Saludo extends Controller
{
    public function index()
    {
       echo "Holis bbys";
    }

    /**
     * La función "comentarios" en PHP devuelve una cadena codificada en JSON que contiene un
     * comentario.
     */
    public function comentarios(){
        $comentarios ="Quiro ..";
        echo json_encode($comentarios);

    }

    public function mensajes($id){
        if(!is_numeric($id)){
            $respuesta = array(
                'error'=> true,
                'mensaje'=> 'Debe ser numerico'
            );
            echo json_encode($respuesta);
            return;
        }

        $mensajes = array(
            array('id'=> 1, 'mensaje'=>'Mesias el mejor'),
            array('id'=>2, 'mensaje'=>'Ella no te ama'),
            array('id'=>3, 'mensaje'=>'Tu ex si')
        );

        if($id >=count($mensajes) OR $id < 0){
            $respuesta = array(
                'error'=> true,
                'mensaje'=> 'El id no existe'
            );
            echo json_encode($respuesta);
            return;
            
        }
        echo json_encode($mensajes[$id]);
    }
}


