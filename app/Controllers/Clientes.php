<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\ClientesModel;
use App\Models\RegistrosModel;
class Clientes extends Controller {
    public function index(){
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $headers = $request->getHeaders();
        $model = new RegistrosModel();
        $registro = $model->where('estado', 1)->findAll();
        
        foreach($registro as $key=>$value){
            if(array_key_exists('Authorization',$headers)&& !empty($headers['Authorization'])){
                
                if($request->getHeader('Authorization')=='Authorization: Basic '.base64_encode($value['cliente_id'].':'.$value['llave_secreta'])){
                    $model = new ClientesModel();
                    $cliente = $model->where('estado',1)->findAll();
                    if(!empty($cliente)){
                        $data = array(
                            "Status"=>200, 
                            "Total de registros"=>count($cliente),
                            "Detalle"=>$cliente
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
                    $model = new ClientesModel();
                    $cliente = $model->where('estado',1)->find($id);
                    //var_dump($cliente); die;
                    if(!empty($cliente)){
                        $data = array(
                            "Status"=>200, "Detalle"=>$cliente);
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
                        "nameClient"=>$request->getVar("nameClient"),
                        "direccionCli"=>$request->getVar("direccionCli"),
                        "correoClient"=>$request->getVar("correoClient"),
                        "numberClient"=>$request->getVar("numberClient"),
                        "genero"=>$request->getVar("genero"),
                        "fechaNacimiento"=>$request->getVar("fechaNacimiento"),
                        "tipodocu"=>$request->getVar("tipodocu"),
                        "numerodocu"=>$request->getVar("numerodocu")
                    );
                    if(!empty($datos)){
                        $validation->setRules([
                            "nameClient"=>'required|string|max_length[255]',
                            "direccionCli"=>'required|string|max_length[255]',
                            "correoClient"=>'required|valid_email',
                            "numberClient"=>'required|string|max_length[255]',
                            "genero"=>'required|string|max_length[255]',
                            "fechaNacimiento"=>'required|string|max_length[255]',
                            "tipodocu"=>'required|string|max_length[255]',
                            "numerodocu"=>'required|string|max_length[255]'
                        ]);
                        $validation->withRequest($this->request)->run();
                        if($validation->getErrors()){
                            $errors = $validation->getErrors();
                            $data = array("Status"=>404, "Detalle"=>$errors);
                            return json_encode($data, true);
                        }
                        else{
                            $datos = array(
                                "nameClient"=>$datos["nameClient"],
                                "direccionCli"=>$datos["direccionCli"],
                                "correoClient"=>$datos["correoClient"],
                                "numberClient"=>$datos["numberClient"],
                                "genero"=>$datos["genero"],
                                "fechaNacimiento"=>$datos["fechaNacimiento"],
                                "tipodocu"=>$datos["tipodocu"],
                                "numerodocu"=>$datos["numerodocu"]
                            );
                            $model = new ClientesModel();
                            $cliente = $model->insert($datos);
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
                            "nameClient"=>'required|string|max_length[255]',
                            "direccionCli"=>'required|string|max_length[255]',
                            "correoClient"=>'required|valid_email',
                            "numberClient"=>'required|string|max_length[255]',
                            "genero"=>'required|string|max_length[255]',
                            "fechaNacimiento"=>'required|string|max_length[255]',
                            "tipodocu"=>'required|string|max_length[255]',
                            "numerodocu"=>'required|string|max_length[255]'
                        ]);
                        $validation->withRequest($this->request)->run();
                        if($validation->getErrors()){
                            $errors = $validation->getErrors();
                            $data = array("Status"=>404, "Detalle"=>$errors);
                            return json_encode($data, true);
                        }
                        else{
                            $model = new ClientesModel();
                            $cliente = $model->find($id);
                            if(is_null($cliente)){
                                $data = array(
                                    "Status"=>404,
                                    "Detalles"=>"Registro no existe"
                                );
                                return json_encode($data, true);
                            }
                            else{
                                $datos = array(
                                    "nameClient"=>$datos["nameClient"],
                                    "direccionCli"=>$datos["direccionCli"],
                                    "correoClient"=>$datos["correoClient"],
                                    "numberClient"=>$datos["numberClient"],
                                    "genero"=>$datos["genero"],
                                    "fechaNacimiento"=>$datos["fechaNacimiento"],
                                    "tipodocu"=>$datos["tipodocu"],
                                    "numerodocu"=>$datos["numerodocu"]
                            );
                            $model = new ClientesModel();
                            $cliente = $model->update($id, $datos);
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
                    $model = new ClientesModel();
                    $cliente = $model->where('estado',1)->find($id);
                    //var_dump($cliente); die;
                    if(!empty($cliente)){
                        $datos = array("estado"=>0);
                        $cliente = $model->update($id, $datos);
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