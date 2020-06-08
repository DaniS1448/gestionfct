<?php

class Titulacion extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('titulacion_model');
    }
    
    public function ajaxGetTitulaciones(){
        if(esAjax()){
            echo json_encode($this->titulacion_model->getTitulaciones());
        }
    }
    
    public function ajaxGetTitulacionesByFamiliaProfesional(){
        if(esAjax()){
            $idFamiliaProfesional = isset($_POST['idFamiliaProfesional'])?$_POST['idFamiliaProfesional']:null;
            if($idFamiliaProfesional!=null){
                echo json_encode($this->titulacion_model->getTitulacionesByFamiliaProfesional($idFamiliaProfesional));
            }            
        }
    }

}
?>









