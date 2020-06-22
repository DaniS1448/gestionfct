<?php

class Empresa extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('empresa_model');
    }

    public function c(){
        verificarRol("admin");
        $data['scripts']=['empresa','instituto'];
        frame($this, "empresa/c",$data);
    }
    
    public function ajaxCPost(){
        if(esAjax()){
            $nombre = isset($_POST["nombre"])?$_POST["nombre"]:null;
            $idMunicipio = isset($_POST["idMunicipio"])?$_POST["idMunicipio"]:null;
            $cif = isset($_POST["cif"])?$_POST["cif"]:null;
            $direccion = isset($_POST["direccion"])?$_POST["direccion"]:null;
            $latitud = isset($_POST["latitud"])?$_POST["latitud"]:null;
            $longitud = isset($_POST["longitud"])?$_POST["longitud"]:null;
            $idTitulacion = isset($_POST["idTitulacion"])?$_POST["idTitulacion"]:null;
            
            $respuesta['estado']=false;
            $respuesta['mensaje']="";
            
            if($nombre!=null && $idMunicipio!=null && $cif!=null && $direccion!=null && $latitud!=null && $longitud!=null && $idTitulacion!=null){
                try {
                    $this->empresa_model->c($nombre,$idMunicipio,$cif,$direccion,$latitud,$longitud,$idTitulacion);
                    $respuesta['estado']=true;
                    $respuesta['mensaje']="Empresa $nombre creada correctamente";
                }
                catch (Exception $e) {
                    $respuesta['mensaje']=$e->getMessage();
                }
            } else {
                $respuesta['mensaje']="Faltan datos";
            }
            
            echo json_encode($respuesta);
        }
    }
    
    public function ajaxGetEmpresas(){
        if(esAjax()){
            echo json_encode($this->empresa_model->getEmpresas());
        }
    }
    
    public function ajaxExisteCif(){
        if(esAjax()){
            $cif = isset($_POST["cif"])?$_POST["cif"]:null;
            if($cif != null){
                echo json_encode($this->empresa_model->existeCIF($cif));
            }
        }
    }
}
?>









