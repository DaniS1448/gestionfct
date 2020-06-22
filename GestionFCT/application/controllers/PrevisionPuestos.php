<?php

class PrevisionPuestos extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('PrevisionPuestos_model');
    }

    public function c(){
        verificarRol("admin");
        $data['scripts']=['previsionpuestos'];
        frame($this, "previsionpuestos/c",$data);
    }
    
    public function ajaxCPost(){
        if(esAjax()){
            $numero = isset($_POST["numero"])?$_POST["numero"]:null;
            $idSede = isset($_POST["idSede"])?$_POST["idSede"]:null;
            
            $respuesta['estado']=false;
            $respuesta['mensaje']="";
            
            if($numero!=null && $idSede!=null){
                try {
                    $this->PrevisionPuestos_model->c($numero,$idSede,getAnyoIni());
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
}
?>









