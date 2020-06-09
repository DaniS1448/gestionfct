<?php

class Pais extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('Pais_model');
    }
    
    public function ajaxGetPaises(){
        if(esAjax()){
            echo json_encode($this->Pais_model->getPaises());
        }
    }

}
?>









