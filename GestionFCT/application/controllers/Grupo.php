<?php

class Grupo extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('grupo_model');
    }

    public function c(){
        verificarRol("admin");
        $data['scripts']=['grupo'];
        frame($this, "grupo/c",$data);
    }
    
    public function ajaxCPost(){
        if(esAjax()){
            $nombre = isset($_POST["nombre"])?$_POST["nombre"]:null;
            $idTitulacion = isset($_POST["idTitulacion"])?$_POST["idTitulacion"]:null;
            $idInstituto = isset($_POST["idInstituto"])?$_POST["idInstituto"]:null;
            
            $respuesta['estado']=false;
            $respuesta['mensaje']="";
            
            if($nombre==null){
                $respuesta['mensaje']="El nombre del grupo no puede estar vacío";
            } else {
                if($idTitulacion!=null){
                    if($idInstituto!=null){
                        try {
                            $this->grupo_model->c($nombre,$idTitulacion,$idInstituto,getAnyoIni());
                            $respuesta['estado']=true;
                            $respuesta['mensaje']="Grupo $nombre creado correctamente";
                        }
                        catch (Exception $e) {
                            $respuesta['mensaje']=$e->getMessage();
                        }
                    } else {
                        $respuesta['mensaje']="El campo instituto no puede estar vacío";
                    }
                } else {
                    $respuesta['mensaje']="La titulación no puede estar vacía";
                }
            }
            
            echo json_encode($respuesta);
        }
    }
    

    public function ajaxGetGruposByInstitutoId(){
        if(esAjax()){
            $idInstituto = isset($_POST["idInstituto"])?$_POST["idInstituto"]:null;
            if($idInstituto!=null){
                echo json_encode($this->grupo_model->getGruposByInstitutoId($idInstituto));
            }
        }
    }
}
?>









