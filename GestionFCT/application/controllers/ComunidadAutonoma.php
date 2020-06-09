<?php

class ComunidadAutonoma extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('ComunidadAutonoma_model');
    }
    
    public function ajaxGetComunidadesAutonomas(){
        if(esAjax()){
            echo json_encode($this->ComunidadAutonoma_model->getComunidadesAutonomas());
        }
    }

}
?>









