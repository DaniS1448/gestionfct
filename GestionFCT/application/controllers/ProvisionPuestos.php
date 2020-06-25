<?php

class ProvisionPuestos extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('ProvisionPuestos_model');
    }

    public function c(){
        verificarRol("admin");
        $data['scripts']=['provisionpuestos'];
        frame($this, "provisionpuestos/c",$data);
    }
    
    public function ajaxCPost(){
        if(esAjax()){
            $numero = isset($_POST["numero"])?$_POST["numero"]:null;
            $idSede = isset($_POST["idSede"])?$_POST["idSede"]:null;
            
            $respuesta['estado']=false;
            $respuesta['mensaje']="";
            
            if($numero!=null && $idSede!=null){
                try {
                    $this->ProvisionPuestos_model->c($numero,$idSede,getAnyoIni());
                    $respuesta['estado']=true;
                    $respuesta['mensaje']="Prevision $numero creada correctamente";
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
    
    public function u(){
        verificarRol("admin");
        $data['scripts']=['provisionpuestos'];
        frame($this, "provisionpuestos/u",$data);
    }
    
    public function ajaxUPost(){
        if(esAjax()){
            $numero = isset($_POST["numero"])?$_POST["numero"]:null;
            $idSede = isset($_POST["idSede"])?$_POST["idSede"]:null;
            
            $respuesta['estado']=false;
            $respuesta['mensaje']="";
            
            if($numero!=null && $idSede!=null){
                try {
                    $this->ProvisionPuestos_model->u($numero,$idSede,getAnyoIni());
                    $respuesta['estado']=true;
                    $respuesta['mensaje']="Prevision $numero modificada correctamente";
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
    
    public function ajaxGetProvisionPuestosBySedeId(){
        if(esAjax()){
            $idSede = isset($_POST['idSede'])?$_POST['idSede']:null;
            if($idSede!=null){
                echo ($this->ProvisionPuestos_model->getProvisionPuestosBySedeId($idSede))->numero;
            }
        }
    }
}
?>









