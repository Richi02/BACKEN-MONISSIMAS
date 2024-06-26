<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\ProductosModel;
use App\Models\RegistrosModel;
class Productos extends Controller{
    public function index(){
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $headers = $request->getHeaders();
        $model = new RegistrosModel();
        $registro = $model->where('estado', 1)->findAll();
         
        foreach($registro as $key=>$value){
            if(array_key_exists('Authorization',$headers) && !empty($headers['Authorization'])){
                if($request->getHeader('Authorization')=='Authorization: Basic '.base64_encode($value['cliente_id'].':'.$value['llave_secreta'])){
                    $model = new ProductosModel();
                    $producto = $model->getProductos();
                    if(!empty($producto)){
                        $data = array(
                            "Status"=>200,
                            "Total de registros"=>count($producto), 
                            "Detalle"=>$producto);
                    }
                    else{
                        $data = array(
                            "Status"=>404,
                            "Total de registros"=>0, 
                            "Detalle"=>"No hay registros");
                    }
                    return json_encode($data, true);
                }
                else{
                    $data = array(
                        "Status"=>404,
                        "Detalles"=>"El token es incorrecto"
                    );
                }
            }
            else{
                $data = array(
                    "Status"=>404,
                    "Detalles"=>"No posee autorización"
                );
            }
        }
        return json_encode($data, true);        
    }
    public function show($id){
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $headers = $request->getHeaders();
        $model = new RegistrosModel();
        $registro = $model->where('estado', 1)->findAll();
         
        foreach($registro as $key=>$value){
            if(array_key_exists('Authorization',$headers) && !empty($headers['Authorization'])){
                if($request->getHeader('Authorization')=='Authorization: Basic '.base64_encode($value['cliente_id'].':'.$value['llave_secreta'])){
                    $model = new ProductosModel();
                    $producto = $model->getId($id);
                    if(!empty($producto)){
                        $data = array(
                            "Status"=>200, "Detalle"=>$producto);
                    }
                    else{
                        $data = array(
                            "Status"=>404, "Detalle"=>"No hay registros");
                    }
                    return json_encode($data, true);
                }
                else{
                    $data = array(
                        "Status"=>404,
                        "Detalles"=>"El token es incorrecto"
                    );
                }
            }
            else{
                $data = array(
                    "Status"=>404,
                    "Detalles"=>"No posee autorización"
                );
            }
        }
        return json_encode($data, true);
    }
    public function create(){
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $headers = $request->getHeaders();
        $model = new RegistrosModel();
        $registro = $model->where('estado', 1)->findAll();
        // var_dump($registro); die; 
        foreach($registro as $key=>$value){
            if(array_key_exists('Authorization',$headers) && !empty($headers['Authorization'])){
                if($request->getHeader('Authorization')=='Authorization: Basic '.base64_encode($value['cliente_id'].':'.$value['llave_secreta'])){
                        $datos = array(
                            "nombreproducto"=>$request->getVar("nombreproducto"),
                            "descripciones"=>$request->getVar("descripciones"),
                            "precionormal"=>$request->getVar("precionormal"),
                            "preciorebajado"=>$request->getVar("preciorebajado"),
                            "stoks"=>$request->getVar("stoks"),
                            "imagen"=>$request->getVar("imagen"),
                            "ID_CATEGORIA"=>$request->getVar("ID_CATEGORIA")
                        );
                        if(!empty($datos)){
                            $validation->setRules([
                                "nombreproducto"=>'required|string|max_length[255]',
                                "descripciones"=>'required|string|max_length[255]',
                                "precionormal"=>'required|string|max_length[255]',
                                "preciorebajado"=>'required|string|max_length[255]',
                                "stoks"=>'required|string|max_length[255]',
                                "imagen"=>'required|string|max_length[255]',
                                "ID_CATEGORIA"=>'required|integer'
                            ]);
                            $validation->withRequest($this->request)->run();
                            if($validation->getErrors()){
                                $errors = $validation->getErrors();
                                $data = array("Status"=>404, "Detalle"=>$errors);
                                return json_encode($data, true);
                            }
                            else{
                                $datos = array(
                                        "nombreproducto"=>$datos["nombreproducto"],
                                        "descripciones"=>$datos["descripciones"],
                                        "precionormal"=>$datos["precionormal"],
                                        "preciorebajado"=>$datos["preciorebajado"],
                                        "stoks"=>$datos["stoks"],
                                        "imagen"=>$datos["imagen"],
                                        "ID_CATEGORIA"=>$datos["ID_CATEGORIA"]
                                );
                                $model = new ProductosModel();
                                $producto = $model->insert($datos);
                                $data = array(
                                    "Status"=>200,
                                    "Detalle"=>"Registro existoso"
                                );
                                return json_encode($data, true);
                            }
                        }
                        else{
                            $data = array(
                                "Status"=>404,
                                "Detalle"=>"Registro con errores"
                            );
                            return json_encode($data, true);
                        }
                }
                else{
                    $data = array(
                        "Status"=>404,
                        "Detalles"=>"El token es incorrecto"
                    );
                }
            }
            else{
                $data = array(
                    "Status"=>404,
                    "Detalles"=>"No posee autorización"
                );
            }
        }
        return json_encode($data, true);
    }
    public function update($id){
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $headers = $request->getHeaders();
        $model = new RegistrosModel();
        $registro = $model->where('estado', 1)->findAll();
        foreach($registro as $key=>$value){
            if(array_key_exists('Authorization',$headers) && !empty($headers['Authorization'])){
                if($request->getHeader('Authorization')=='Authorization: Basic '.base64_encode($value['cliente_id'].':'.$value['llave_secreta'])){
                        
                        $datos = $this->request->getRawInput();
                        
                        if(!empty($datos)){
                             $validation->setRules([
                                "nombreproducto"=>'required|string|max_length[255]',
                                "descripciones"=>'required|string|max_length[255]',
                                "precionormal"=>'required|string|max_length[255]',
                                "preciorebajado"=>'required|string|max_length[255]',
                                "stoks"=>'required|string|max_length[255]',
                                "imagen"=>'required|string|max_length[255]',
                                "ID_CATEGORIA"=>'required|integer'
                            ]);
                            $validation->withRequest($this->request)->run();
                            if($validation->getErrors()){
                                $errors = $validation->getErrors();
                                $data = array("Status"=>404, "Detalle"=>$errors);
                                return json_encode($data, true);
                            }
                            else{
                                $model = new ProductosModel();
                                $producto = $model->find($id);
                                if(is_null($producto)){
                                    $data = array(
                                        "Status"=>404,
                                        "Detalles"=>"Registro no existe"
                                    );
                                    return json_encode($data, true);
                                }
                                else{
                                    $datos = array(
                                        "nombreproducto"=>$datos["nombreproducto"],
                                        "descripciones"=>$datos["descripciones"],
                                        "precionormal"=>$datos["precionormal"],
                                        "preciorebajado"=>$datos["preciorebajado"],
                                        "stoks"=>$datos["stoks"],
                                        "imagen"=>$datos["imagen"],
                                        "ID_CATEGORIA"=>$datos["ID_CATEGORIA"]
                                    );
                                    $model = new ProductosModel();
                                    $producto = $model->update($id, $datos);
                                    $data = array(
                                        "Status"=>200,
                                        "Detalles"=>"Datos actualizados"
                                    );
                                    return json_encode($data, true);
                                }
                            }
                        }
                        else{
                            $data = array(
                                "Status"=>404,
                                "Detalle"=>"Registro con errores"
                            );
                            return json_encode($data, true);
                        }
                }
                else{
                    $data = array(
                        "Status"=>404,
                        "Detalles"=>"El token es incorrecto"
                    );
                }
            }
            else{
                $data = array(
                    "Status"=>404,
                    "Detalles"=>"No posee autorización"
                );
            }
        }
        return json_encode($data, true);
    }
    public function delete($id){
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $headers = $request->getHeaders();
        $model = new RegistrosModel();
        $registro = $model->where('estado', 1)->findAll();
         
        foreach($registro as $key=>$value){
            if(array_key_exists('Authorization',$headers) && !empty($headers['Authorization'])){
                if($request->getHeader('Authorization')=='Authorization: Basic '.base64_encode($value['cliente_id'].':'.$value['llave_secreta'])){
                    $model = new ProductosModel();
                    $producto = $model->where('estado',1)->find($id);
                    if(!empty($producto)){
                        $datos = array("estado"=>0);
                        $producto = $model->update($id, $datos);
                        $data = array(
                            "Status"=>200,
                            "Detalle"=>"Se ha eliminado el registro"
                        );
                    }
                    else{
                        $data = array(
                            "Status"=>404, 
                            "Detalle"=>"No hay registros");
                    }
                    return json_encode($data, true);
                }
                else{
                    $data = array(
                        "Status"=>404,
                        "Detalles"=>"El token es incorrecto"
                    );
                }
            }
            else{
                $data = array(
                    "Status"=>404,
                    "Detalles"=>"No posee autorización"
                );
            }
        }
        return json_encode($data, true);
    }
}