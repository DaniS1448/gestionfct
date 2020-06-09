<?php

class Municipio extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('Municipio_model');
    }
    
    public function ajaxGetMunicipios(){
        if(esAjax()){
            echo json_encode($this->Municipio_model->getMunicipios());
        }
    }
    
    public function ajaxGetMunicipioById(){
        if(esAjax()){
            $id = isset($_POST["id"])?$_POST["id"]:null;
            if($id != null){
                echo json_encode($this->Municipio_model->getMunicipioById($id));
            }
        }
    }
    
    public function ajaxGetMunicipiosLike(){
        if(esAjax()){
            $nombre = isset($_POST["nombre"])?$_POST["nombre"]:"";
            //echo json_encode($this->Municipio_model->getMunicipiosLike());
            
            $arrInstitutos=[];
            
            foreach ($this->Municipio_model->getMunicipiosLike($nombre) as $municipio){
                $atributos=[];
                foreach ($municipio as $k=>$v){
                    $atributos[$k]=$v;
                }
                $atributos["provincia"]=$municipio->provincia->nombre;
                $atributos["comunidad"]=$municipio->provincia->comunidadautonoma->nombre;
                $arrInstitutos[]=$atributos;
            }
            echo json_encode($arrInstitutos);
        }
    }

}
?>









