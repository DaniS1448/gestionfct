<?php

class Alumno extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('alumno_model');
    }
    
    public function c(){
        $data['scripts']=['alumno','apiplaces'];
        
        if(devolverRol()=="admin"){
            frame($this, "alumno/cAdmin",$data);
        } elseif (devolverRol() == "auth") {
            frame($this, "alumno/cAuth",$data);
        } else {
            redirect(base_url());
        }
    }
    
    public function ajaxCPost(){
        if(esAjax()){
            $idGrupo = isset($_POST["idGrupo"])?$_POST["idGrupo"]:null;
            $nombre = isset($_POST["nombre"])?$_POST["nombre"]:null;
            $apellido = isset($_POST["apellido"])?$_POST["apellido"]:null;
            $dni = isset($_POST["dni"])?$_POST["dni"]:null;
            $direccion = isset($_POST["direccion"])?$_POST["direccion"]:null;
            $latitud = isset($_POST["latitud"])?$_POST["latitud"]:null;
            $longitud = isset($_POST["longitud"])?$_POST["longitud"]:null;
            
            $respuesta['estado']=false;
            $respuesta['mensaje']="";
            
            if($idGrupo==null){
                $respuesta['mensaje']="El grupo no puede estar vacío";
            } else {
                try {
                    $this->alumno_model->c($idGrupo,$nombre,$apellido,$dni,$direccion,$latitud,$longitud);
                    $respuesta['estado']=true;
                    $respuesta['mensaje']="Alumno $nombre creado correctamente";
                }
                catch (Exception $e) {
                    $respuesta['mensaje']=$e->getMessage();
                }
            }
            
            echo json_encode($respuesta);
        }
    }
    
    public function ajaxExisteDni(){
        if(esAjax()){
            $dni = isset($_POST["dni"])?$_POST["dni"]:null;
            if($dni != null){
                echo json_encode($this->alumno_model->existeDNI($dni));
            }
        }
    }

}
?>









