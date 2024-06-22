<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\VentasModel;
use App\Models\RegistrosModel;
class Ventas extends Controller{
    public function index(){
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $headers = $request->getHeaders();
        $model = new RegistrosModel();
        $registro = $model->where('estado', 1)->findAll();
         
        foreach($registro as $key=>$value){
            if(array_key_exists('Authorization',$headers) && !empty($headers['Authorization'])){
                if($request->getHeader('Authorization')=='Authorization: Basic '.base64_encode($value['cliente_id'].':'.$value['llave_secreta'])){
                    $model = new VentasModel();
                    $venta = $model->getVentas();
                    if(!empty($venta)){
                        $data = array(
                            "Status"=>200,
                            "Total de registros"=>count($venta), 
                            "Detalle"=>$venta);
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
                    $model = new VentasModel();
                    $venta = $model->getId($id);
                    if(!empty($venta)){
                        $data = array(
                            "Status"=>200, "Detalle"=>$venta);
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
                            "ID_PRODUCTO"=>$request->getVar("ID_PRODUCTO"),
                            "ID_USUARIO"=>$request->getVar("ID_USUARIO"),
                            "precios"=>$request->getVar("precios"),
                            "cantidades"=>$request->getVar("cantidades"),
                            "fecha"=>$request->getVar("fecha"),
                            "subtotal"=>$request->getVar("subtotal"),
                            "totalventa"=>$request->getVar("totalventa"),
                            "ID_TIPOPAGO"=>$request->getVar("ID_TIPOPAGO")
                        );
                        if(!empty($datos)){
                            $validation->setRules([
                                "ID_PRODUCTO"=>'required|integer',
                                "ID_USUARIO"=>'required|integer',
                                "precios"=>'required|integer',
                                "cantidades"=>'required|integer',
                                "fecha"=>'required|string|max_length[255]',
                                "subtotal"=>'required|integer',
                                "totalventa"=>'required|integer',
                                "ID_TIPOPAGO"=>'required|integer'
                            ]);
                            $validation->withRequest($this->request)->run();
                            if($validation->getErrors()){
                                $errors = $validation->getErrors();
                                $data = array("Status"=>404, "Detalle"=>$errors);
                                return json_encode($data, true);
                            }
                            else{
                                $datos = array(
                                    "ID_PRODUCTO"=>$datos["ID_PRODUCTO"],
                                    "ID_USUARIO"=>$datos["ID_USUARIO"],
                                    "precios"=>$datos["precios"],
                                    "cantidades"=>$datos["cantidades"],
                                    "fecha"=>$datos["fecha"],
                                    "subtotal"=>$datos["subtotal"],
                                    "totalventa"=>$datos["totalventa"],
                                    "IP_TIPOPAGO"=>$datos["IP_TIPOPAGO"]
                                );
                                $model = new VentasModel();
                                $venta = $model->insert($datos);
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
                                "ID_PRODUCTO"=>'required|integer',
                                "ID_USUARIO"=>'required|integer',
                                "precios"=>'required|integer',
                                "cantidades"=>'required|integer',
                                "fecha"=>'required|string|max_length[255]',
                                "subtotal"=>'required|integer',
                                "totalventa"=>'required|integer',
                                "ID_TIPOPAGO"=>'required|integer'
                            ]);
                            $validation->withRequest($this->request)->run();
                            if($validation->getErrors()){
                                $errors = $validation->getErrors();
                                $data = array("Status"=>404, "Detalle"=>$errors);
                                return json_encode($data, true);
                            }
                            else{
                                $model = new VentasModel();
                                $venta = $model->find($id);
                                if(is_null($venta)){
                                    $data = array(
                                        "Status"=>404,
                                        "Detalles"=>"Registro no existe"
                                    );
                                    return json_encode($data, true);
                                }
                                else{
                                    $datos = array(
                                        "ID_PRODUCTO"=>$datos["ID_PRODUCTO"],
                                        "ID_USUARIO"=>$datos["ID_USUARIO"],
                                        "precios"=>$datos["precios"],
                                        "cantidades"=>$datos["cantidades"],
                                        "fecha"=>$datos["fecha"],
                                        "subtotal"=>$datos["subtotal"],
                                        "totalventa"=>$datos["totalventa"],
                                        "IP_TIPOPAGO"=>$datos["IP_TIPOPAGO"]
                                    );
                                    $model = new VentasModel();
                                    $venta = $model->update($id, $datos);
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
                    $model = new VentasModel();
                    $venta = $model->where('estado',1)->find($id);
                    if(!empty($venta)){
                        $datos = array("estado"=>0);
                        $venta = $model->update($id, $datos);
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