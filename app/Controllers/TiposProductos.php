<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\TiposproductosModel;
use App\Models\RegistrosModel;
class TiposProductos extends Controller {
    public function index(){
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $headers = $request->getHeaders();
        $model = new RegistrosModel();
        $registro = $model->where('estado', 1)->findAll();
        
        foreach($registro as $key=>$value){
            if(array_key_exists('Authorization',$headers)&& !empty($headers['Authorization'])){
                if($request->getHeader('Authorization')=='Authorization: Basic '.base64_encode($value['cliente_id'].':'.$value['llave_secreta'])){
                    $model = new TiposproductosModel();
                    $tipoproducto = $model->where('estado',1)->findAll();
                    if(!empty($tipoproducto)){
                        $data = array(
                            "Status"=>200, 
                            "Total de registros"=>count($tipoproducto),
                            "Detalle"=>$tipoproducto
                        );
                    }
                    else{
                        $data = array(
                            "Status"=>404,
                            "Total de registros"=>0,
                            "Detalles"=>"No hay registros"
                        );
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
            if(array_key_exists('Authorization',$headers)&& !empty($headers['Authorization'])){
                
                if($request->getHeader('Authorization')=='Authorization: Basic '.base64_encode($value['cliente_id'].':'.$value['llave_secreta'])){
                    $model = new TiposproductosModel();
                    $tipoproducto = $model->where('estado',1)->find($id);
                    //var_dump($tipoproducto); die;
                    if(!empty($tipoproducto)){
                        $data = array(
                            "Status"=>200, "Detalle"=>$tipoproducto);
                    }
                    else{
                        $data = array(
                            "Status"=>404,
                            "Detalles"=>"No hay registros"
                        );
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
        foreach($registro as $key=>$value){
            if(array_key_exists('Authorization',$headers)&& !empty($headers['Authorization'])){
                if($request->getHeader('Authorization')=='Authorization: Basic '.base64_encode($value['cliente_id'].':'.$value['llave_secreta'])){
                    $datos = array(
                        "marca"=>$request->getVar("marca")
                    );
                    if(!empty($datos)){
                        $validation->setRules([
                            "marca"=>'required|string|max_length[255]'
                        ]);
                        $validation->withRequest($this->request)->run();
                        if($validation->getErrors()){
                            $errors = $validation->getErrors();
                            $data = array("Status"=>404, "Detalle"=>$errors);
                            return json_encode($data, true);
                        }
                        else{
                            $datos = array(
                                "marca"=>$datos["marca"]
                            );
                            $model = new TiposproductosModel();
                            $tipoproducto = $model->insert($datos);
                            $data = array(
                                "Status"=>200,
                                "Detalle"=>"Registro exitoso"
                            );
                            return json_encode($data, true);
                        }
                    }
                    else{
                        $data = array(
                            "Status"=>400,
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
            if(array_key_exists('Authorization',$headers)&& !empty($headers['Authorization'])){
                if($request->getHeader('Authorization')=='Authorization: Basic '.base64_encode($value['cliente_id'].':'.$value['llave_secreta'])){
                    $datos = $this->request->getRawInput();
                    if(!empty($datos)){
                        $validation->setRules([
                            "marca"=>'required|string|max_length[255]'
                        ]);
                        $validation->withRequest($this->request)->run();
                        if($validation->getErrors()){
                            $errors = $validation->getErrors();
                            $data = array("Status"=>404, "Detalle"=>$errors);
                            return json_encode($data, true);
                        }
                        else{
                            $model = new TiposproductosModel();
                            $tipoproducto = $model->find($id);
                            if(is_null($tipoproducto)){
                                $data = array(
                                    "Status"=>404,
                                    "Detalles"=>"Registro no existe"
                                );
                                return json_encode($data, true);
                            }
                            else{
                                $datos = array(
                                "marca"=>$datos["marca"]
                            );
                            $model = new TiposproductosModel();
                            $tipoproducto = $model->update($id, $datos);
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
                            "Status"=>400,
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
            if(array_key_exists('Authorization',$headers)&& !empty($headers['Authorization'])){
                
                if($request->getHeader('Authorization')=='Authorization: Basic '.base64_encode($value['cliente_id'].':'.$value['llave_secreta'])){
                    $model = new TiposproductosModel();
                    $tipoproducto = $model->where('estado',1)->find($id);
                    //var_dump($tipoproducto); die;
                    if(!empty($tipoproducto)){
                        $datos = array("estado"=>0);
                        $tipoproducto = $model->update($id, $datos);
                        $data = array(
                            "Status"=>200, 
                            "Detalle"=>"Se ha eliminado el registro"
                        );
                    }
                    else{
                        $data = array(
                            "Status"=>404,
                            "Detalles"=>"No hay registros");
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