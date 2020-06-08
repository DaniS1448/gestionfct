<?php

class CursoAcademico extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('cursoAcademico_model');
    }

    public function c(){
        verificarRol("admin");
        frame($this, "cursoAcademico/c");
    }
    
    public function cPost(){
        verificarRol("admin");
        $anyoini = isset($_POST["anyoini"])?$_POST["anyoini"]:null;
        $idCursoAnterior = isset($_POST["idCursoAnterior"])?$_POST["idCursoAnterior"]:null;
        if($idCursoAnterior==null && $anyoini!=null){
            $this->cursoAcademico_model->c($anyoini);
            //crearModalAviso("success", "Curso académico creado correctamente","/");
            
        } else if($idCursoAnterior!=null && $anyoini!=null) {
            
        }
        
    }
    
    public function ajaxGetCursosAcademicos(){
        $esAjax = isset(
            $_SERVER['HTTP_X_REQUESTED_WITH'])?
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' :
            false;
            if ($esAjax) {

                echo json_encode($this->cursoAcademico_model->getCursosAcademicos());
                
            }
            else {
                echo "SOLO EJECUCIONES AJAX";
            }
    }

}
?>









