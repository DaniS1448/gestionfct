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
        
        if($anyoini==null){
            session_start_seguro();
            $_SESSION['_msg']['tipo']="danger";
            $_SESSION['_msg']['texto']="El año de cominezo no puede estar vacío";
            $_SESSION['_msg']['uri']='cursoAcademico/c';
            redirect(base_url() . 'msg');
        } else {
            if($idCursoAnterior==null){
                try {
                    $this->cursoAcademico_model->c($anyoini);
                    redirect(base_url() . '/');
                }
                catch (Exception $e) {
                    session_start_seguro();
                    $_SESSION['_msg']['tipo']="danger";
                    $_SESSION['_msg']['texto']=$e->getMessage();
                    $_SESSION['_msg']['uri']='cursoAcademico/c';
                    redirect(base_url() . 'msg');
                }
            } else {
                
            }
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









