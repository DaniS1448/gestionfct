<?php

class Sede extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('Sede_model');
    }
    
    public function c(){
        verificarRol("admin");
        $data['scripts']=['sede'];
        frame($this, "sede/c",$data);
    }
    
    public function ajaxCPost(){
        if(esAjax()){
            $direccion = isset($_POST["direccion"])?$_POST["direccion"]:null;
            $latitud = isset($_POST["latitud"])?$_POST["latitud"]:null;
            $longitud = isset($_POST["longitud"])?$_POST["longitud"]:null;
            $idEmpresa = isset($_POST["idEmpresa"])?$_POST["idEmpresa"]:null;
            
            $respuesta['estado']=false;
            $respuesta['mensaje']="";
            
            if($direccion!=null && $latitud!=null && $longitud!=null && $idEmpresa!=null){
                try {
                    $this->Sede_model->c($direccion,$latitud,$longitud,$idEmpresa);
                    $respuesta['estado']=true;
                    $respuesta['mensaje']="Sede $direccion creada correctamente";
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
    
    public function ajaxGetSedesByEmpresa(){
        if(esAjax()){
            $idEmpresa = isset($_POST['idEmpresa'])?$_POST['idEmpresa']:null;
            if($idEmpresa!=null){
                echo json_encode($this->Sede_model->getSedesByEmpresa($idEmpresa));
            }
        }
    }
}
?>









