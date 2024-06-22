<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\SucursalesModel;
use App\Models\RegistrosModel;
class Sucursales extends Controller{
    public function index(){
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $headers = $request->getHeaders();
        $model = new RegistrosModel();
        $registro = $model->where('estado', 1)->findAll();
         
        foreach($registro as $key=>$value){
            if(array_key_exists('Authorization',$headers) && !empty($headers['Authorization'])){
                if($request->getHeader('Authorization')=='Authorization: Basic '.base64_encode($value['cliente_id'].':'.$value['llave_secreta'])){
                    $model = new SucursalesModel();
                    $sucursal = $model->getSucursales();
                    if(!empty($sucursal)){
                        $data = array(
                            "Status"=>200,
                            "Total de registros"=>count($sucursal), 
                            "Detalle"=>$sucursal);
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
                    $model = new SucursalesModel();
                    $sucursal = $model->getId($id);
                    if(!empty($sucursal)){
                        $data = array(
                            "Status"=>200, "Detalle"=>$sucursal);
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
                            "sucunombre"=>$request->getVar("sucunombre"),
                            "sucudireccion"=>$request->getVar("sucudireccion"),
                            "sucutelefono"=>$request->getVar("sucutelefono"),
                            "horario"=>$request->getVar("horario"),
                            "idservicios"=>$request->getVar("idservicios"),
                            "empleados"=>$request->getVar("empleados"),
                            "idempresa"=>$request->getVar("idempresa")
                        );
                        if(!empty($datos)){
                            $validation->setRules([
                                "sucunombre"=>'required|string|max_length[255]',
                                "sucudireccion"=>'required|string|max_length[255]',
                                "sucutelefono"=>'required|string|max_length[255]',
                                "horario"=>'required|string|max_length[255]',
                                "idservicios"=>'required|integer',
                                "empleados"=>'required|string|max_length[255]',
                                "idempresa"=>'required|integer'
                            ]);
                            $validation->withRequest($this->request)->run();
                            if($validation->getErrors()){
                                $errors = $validation->getErrors();
                                $data = array("Status"=>404, "Detalle"=>$errors);
                                return json_encode($data, true);
                            }
                            else{
                                $datos = array(
                                        "sucunombre"=>$datos["sucunombre"],
                                        "sucudireccion"=>$datos["sucudireccion"],
                                        "sucutelefono"=>$datos["sucutelefono"],
                                        "horario"=>$datos["horario"],
                                        "idservicios"=>$datos["idservicios"],
                                        "empleados"=>$datos["empleados"],
                                        "idempresa"=>$datos["idempresa"]
                                );
                                $model = new SucursalesModel();
                                $sucursal = $model->insert($datos);
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
                                "sucunombre"=>'required|string|max_length[255]',
                                "sucudireccion"=>'required|string|max_length[255]',
                                "sucutelefono"=>'required|string|max_length[255]',
                                "horario"=>'required|string|max_length[255]',
                                "idservicios"=>'required|integer',
                                "empleados"=>'required|string|max_length[255]',
                                "idempresa"=>'required|integer'
                            ]);
                            $validation->withRequest($this->request)->run();
                            if($validation->getErrors()){
                                $errors = $validation->getErrors();
                                $data = array("Status"=>404, "Detalle"=>$errors);
                                return json_encode($data, true);
                            }
                            else{
                                $model = new SucursalesModel();
                                $sucursal = $model->find($id);
                                if(is_null($sucursal)){
                                    $data = array(
                                        "Status"=>404,
                                        "Detalles"=>"Registro no existe"
                                    );
                                    return json_encode($data, true);
                                }
                                else{
                                    $datos = array(
                                        "sucunombre"=>$datos["sucunombre"],
                                        "sucudireccion"=>$datos["sucudireccion"],
                                        "sucutelefono"=>$datos["sucutelefono"],
                                        "horario"=>$datos["horario"],
                                        "idservicios"=>$datos["idservicios"],
                                        "empleados"=>$datos["empleados"],
                                        "idempresa"=>$datos["idempresa"]
                                    );
                                    $model = new SucursalesModel();
                                    $sucursal = $model->update($id, $datos);
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
                    $model = new SucursalesModel();
                    $sucursal = $model->where('estado',1)->find($id);
                    if(!empty($sucursal)){
                        $datos = array("estado"=>0);
                        $sucursal = $model->update($id, $datos);
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