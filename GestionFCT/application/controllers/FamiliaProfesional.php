<?php

class FamiliaProfesional extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('FamiliaProfesional_model');
    }
    
    public function ajaxGetFamiliasProfesionales(){
        if(esAjax()){
            echo json_encode($this->FamiliaProfesional_model->getFamiliasProfesionales());
        }
    }

}
?>









