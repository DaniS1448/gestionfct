<?php

class CursoAcademico extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('cursoAcademico_model');
    }

    public function c(){
        verificarRol("admin");
        $data['scripts']=['cursoacademico'];
        frame($this, "cursoAcademico/c",$data);
    }
    
    public function ajaxCPost(){
        if(esAjax()){
            $anyoini = isset($_POST["anyoini"])?$_POST["anyoini"]:null;
            $idCursoAnterior = isset($_POST["idCursoAnterior"])?$_POST["idCursoAnterior"]:null;
            
            $respuesta['estado']=false;
            $respuesta['mensaje']="";
            
            if($anyoini==null){
                $respuesta['estado']=false;
                $respuesta['mensaje']="El año de cominezo no puede estar vacío";
            } else {
                if($idCursoAnterior==null){
                    try {
                        $this->cursoAcademico_model->c($anyoini);
                        $respuesta['estado']=true;
                        $respuesta['mensaje']="Curso académico $anyoini creado correctamente";
                    }
                    catch (Exception $e) {
                        $respuesta['estado']=false;
                        $respuesta['mensaje']=$e->getMessage();
                    }
                } else {
                    //TODO crear curso duplicando anterior
                    try {
                        $this->cursoAcademico_model->cAnterior($anyoini,$idCursoAnterior);
                        $respuesta['estado']=true;
                        $respuesta['mensaje']="Curso académico $anyoini creado correctamente";
                    }
                    catch (Exception $e) {
                        $respuesta['estado']=false;
                        $respuesta['mensaje']=$e->getMessage();
                    }
                }
            }
            
            echo json_encode($respuesta);
        }
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
                    redirect(base_url());
                }
                catch (Exception $e) {
                    session_start_seguro();
                    $_SESSION['_msg']['tipo']="danger";
                    $_SESSION['_msg']['texto']=$e->getMessage();
                    $_SESSION['_msg']['uri']='cursoAcademico/c';
                    redirect(base_url() . 'msg');
                }
            } else {
                //TODO crear curso duplicando anterior
            }
        }
        
    }
    
    public function ajaxGetCursosAcademicos(){
        if(esAjax()){
            echo json_encode($this->cursoAcademico_model->getCursosAcademicos());
        }
    }

}
?>









