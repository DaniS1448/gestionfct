<?php

class Instituto extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('instituto_model');
    }

    public function c(){
        verificarRol("admin");
        $data['scripts']=['instituto'];
        frame($this, "instituto/c",$data);
    }
    
    public function ajaxCPost(){
        if(esAjax()){
            $nombre = isset($_POST["nombre"])?$_POST["nombre"]:null;
            $n_centro = isset($_POST["n_centro"])?$_POST["n_centro"]:null;
            
            $respuesta['estado']=false;
            $respuesta['mensaje']="";
            
            if($nombre==null){
                $respuesta['estado']=false;
                $respuesta['mensaje']="El nombre del instituto no puede estar vacío";
            } else {
                if($n_centro==null){
                    try {
                        $this->instituto_model->c($nombre);
                        $respuesta['estado']=true;
                        $respuesta['mensaje']="Instituto $nombre creado correctamente";
                    }
                    catch (Exception $e) {
                        $respuesta['estado']=false;
                        $respuesta['mensaje']=$e->getMessage();
                    }
                } else {
                    //TODO crear instituto con más datos
                }
            }
            
            echo json_encode($respuesta);
        }
    }
    
    public function ajaxGetInstitutos(){
        if(esAjax()){
            echo json_encode($this->instituto_model->getInstitutos());
        }
    }
    
}
?>









